<?php

namespace Modules\File\Application\Services;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\File\Application\Contracts\FilesToAnalyzeServiceInterface;
use Modules\File\Domain\Contracts\FileRepositoryInterface;
use Modules\File\Domain\Entities\File;
use Modules\File\Domain\Enums\StatusEnum;
use Modules\File\Infrastructure\Events\FilesAnalyzed;
use Modules\File\Infrastructure\Jobs\AnalyzeFileJob;
use Spatie\PdfToImage\Pdf;

final readonly class FilesToAnalyzeService implements FilesToAnalyzeServiceInterface
{
    public function __construct(private FileRepositoryInterface $repository) {}

    public function execute(array $documents): void
    {
        $jobs = [];

        collect($documents)->each(function (TemporaryUploadedFile $file, string $hash) use (&$jobs) {
            $job = null;

            if (in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg'])) {
                $job = $this->manageImageFiles($file, $hash);
            }

            if ($file->getClientOriginalExtension() === 'pdf') {
                $job = $this->managePdfFiles($file, $hash);
            }

            if (! $job) {
                return;
            }

            $jobs[] = $job;
        });

        Bus::batch($jobs)
            ->then(function () {
                FilesAnalyzed::dispatch(auth()->user()->id);
            })
            ->dispatch();
    }

    private function manageImageFiles(TemporaryUploadedFile $file, string $hash): AnalyzeFileJob
    {
        $entity = $this->createAndAddAliase($hash, $file);

        $entity->setBase64(base64_encode(file_get_contents($file->getRealPath())));

        $mimeType = \Illuminate\Support\Facades\File::mimeType($file->getRealPath());
        $base64Image = "data:{$mimeType};base64,".$entity->base64();

        return new AnalyzeFileJob($entity->hash(), $base64Image);
    }

    private function managePdfFiles(TemporaryUploadedFile $file, string $hash): AnalyzeFileJob
    {
        $this->createAndAddAliase($hash, $file);

        $pdf = new Pdf($file->getRealPath());

        Storage::makeDirectory('pdfs');
        $path = storage_path('app/private/pdfs/'.$hash.'.jpg');
        $pdf->save($path);

        if (\Illuminate\Support\Facades\File::exists($path)) {

            $fileContent = \Illuminate\Support\Facades\File::get($path);
            $base64 = base64_encode($fileContent);
            $mimeType = \Illuminate\Support\Facades\File::mimeType($path);
            $base64String = "data:{$mimeType};base64,{$base64}";
            Storage::delete($path);

        } else {
            throw new \Exception('File not found');
        }

        return new AnalyzeFileJob($hash, $base64String);
    }

    private function createAndAddAliase(string $hash, TemporaryUploadedFile $file): File
    {
        $entity = new File(
            hash: $hash,
            mimeType: $file->getClientOriginalExtension(),
            status: StatusEnum::TO_ANALYZE,
            name: $file->getClientOriginalName()
        );

        $this->repository->save($entity);
        $this->repository->addAliase($hash, $entity->name(), auth()->id());

        return $entity;
    }
}
