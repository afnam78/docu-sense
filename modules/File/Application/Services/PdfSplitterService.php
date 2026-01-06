<?php

namespace Modules\File\Application\Services;

use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\File\Application\Contracts\PdfSplitterServiceInterface;
use Modules\File\Domain\Contracts\FileRepositoryInterface;
use Modules\File\Domain\Enums\StatusEnum;
use setasign\Fpdi\Fpdi;

final readonly class PdfSplitterService implements PdfSplitterServiceInterface
{
    public function __construct(
        private FileRepositoryInterface $repository,
    ) {}

    public function execute(TemporaryUploadedFile $file, string $originalHash): array
    {
        Storage::disk('local')->makeDirectory('temp-pdfs');

        $filePath = $file->getRealPath();
        $pdfReader = new Fpdi;
        $pageCount = $pdfReader->setSourceFile($filePath);

        $pages = [];

        for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
            $newPdf = new Fpdi;
            $newPdf->setSourceFile($filePath);
            $newPdf->AddPage();

            $templateId = $newPdf->importPage($pageNumber);
            $newPdf->useTemplate($templateId, 0, 0, null, null, true);

            $singlePagePdfContent = $newPdf->Output('S');

            $pageHash = hash('sha256', $singlePagePdfContent);

            $sheet = $this->repository->find($pageHash);

            if ($sheet) {
                continue;
            }

            $relativePath = 'temp-pdfs/'.$pageHash.'.pdf';

            Storage::disk('local')->put($relativePath, $singlePagePdfContent);
            $pages[$pageHash] = $relativePath;

            $sheetFile = new \Modules\File\Domain\Entities\File(
                hash: $pageHash,
                mimeType: 'pdf',
                status: StatusEnum::TO_ANALYZE,
                fileHash: $originalHash,
            );

            $this->repository->save($sheetFile);
            $this->repository->sync($sheetFile);
        }

        return $pages;
    }
}
