<?php

namespace Modules\File\Application\Services;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\File\Application\Contracts\FilesToAnalyzeServiceInterface;
use Modules\File\Application\Contracts\PdfSplitterServiceInterface;
use Modules\File\Domain\Contracts\FileRepositoryInterface;
use Modules\File\Domain\Contracts\OcrExtractServiceInterface;
use Modules\File\Domain\Entities\File;
use Modules\File\Domain\Enums\StatusEnum;
use Modules\File\Infrastructure\Jobs\AnalyzeFileJob;
use Spatie\PdfToImage\Pdf;

final readonly class FilesToAnalyzeService implements FilesToAnalyzeServiceInterface
{
    public function __construct(
        private FileRepositoryInterface $repository,
        private OcrExtractServiceInterface $ocrExtractService,
        private PdfSplitterServiceInterface $pdfSplitterService,
    ) {}

    public function execute(array $documents): void
    {
        $jobs = [];

        collect($documents)->each(function (TemporaryUploadedFile $file, string $originalHash) use (&$jobs) {
            $job = null;

            if (in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg'])) {
                $job = $this->manageImageFiles($file);
            }

            if ($file->getClientOriginalExtension() === 'pdf') {
                $jobs = array_merge($jobs, $this->managePdfFiles($file, $originalHash));
            }

            if (! $job) {
                return;
            }

            $jobs[] = $job;
        });

        Bus::batch($jobs)->dispatch();
    }

    private function manageImageFiles(TemporaryUploadedFile $file): AnalyzeFileJob
    {
        $hash = hash_file('sha256', $file->getRealPath());
        $entity = $this->createAndAddAlias($hash, $file);

        $entity->setBase64(base64_encode(file_get_contents($file->getRealPath())));

        $mimeType = \Illuminate\Support\Facades\File::mimeType($file->getRealPath());
        $base64Image = "data:{$mimeType};base64,".$entity->base64();

        $ocrText = $this->ocrExtractService->getText($file->getRealPath());
        $hocrData = $this->ocrExtractService->getHexagonalText($file->getRealPath());

        return new AnalyzeFileJob($entity->hash(), $base64Image, auth()->user()->id, $ocrText, $hocrData, $entity->hash());
    }

    private function managePdfFiles(TemporaryUploadedFile $file, string $originalHash): array
    {
        $jobs = [];

        $this->createAndAddAlias($originalHash, $file);

        $splittedPdfPaths = $this->pdfSplitterService->execute($file, $originalHash);

        Storage::disk('local')->makeDirectory('pdfs');

        foreach ($splittedPdfPaths as $hash => $splittedPdfPathItem) {
            $splittedFile = Storage::disk('local')->get($splittedPdfPathItem);

            if (! $splittedFile) {
                continue;
            }

            $pdf = new Pdf(Storage::disk('local')->path($splittedPdfPathItem));

            $relativePath = 'pdfs/'.$hash.'.jpg';
            $path = Storage::disk('local')->path($relativePath);
            $pdf->save($path);

            if (Storage::disk('local')->exists($relativePath)) {
                $fileContent = Storage::disk('local')->get($relativePath);
                $base64 = base64_encode($fileContent);
                $base64String = 'data:image/jpeg;base64,'.$base64;

                $ocrText = $this->ocrExtractService->getText($path);
                $hocrData = $this->ocrExtractService->getHexagonalText($path);

                Storage::disk('local')->delete($splittedPdfPathItem);
                Storage::disk('local')->delete($relativePath);

                $jobs[] = new AnalyzeFileJob($hash, $base64String, auth()->user()->id, $ocrText, $hocrData, $originalHash);
            } else {
                throw new \Exception('File not found');
            }
        }

        return $jobs;
    }

    private function createAndAddAlias(string $hash, TemporaryUploadedFile $file): File
    {
        $entity = new File(
            hash: $hash,
            mimeType: $file->getClientOriginalExtension(),
            status: StatusEnum::TO_ANALYZE,
            name: $file->getClientOriginalName()
        );

        $this->repository->save($entity);
        $this->repository->addAlias($hash, $entity->name(), auth()->id());

        return $entity;
    }
}
