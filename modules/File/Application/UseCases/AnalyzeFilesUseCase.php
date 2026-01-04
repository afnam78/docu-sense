<?php

namespace Modules\File\Application\UseCases;

use Exception;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\File\Application\Commands\AnalyzeFilesCommand;
use Modules\File\Application\Contracts\FilesAlreadyAnalyzedServiceInterface;
use Modules\File\Application\Contracts\FilesToAnalyzeServiceInterface;
use Modules\File\Domain\Contracts\FileRepositoryInterface;

/**
 * Handles the analysis of files based on the given command.
 * This use case interacts with services to determine which files require analysis
 * and which files have already been processed.
 */
final readonly class AnalyzeFilesUseCase
{
    public function __construct(
        private FileRepositoryInterface $repository,
        private FilesToAnalyzeServiceInterface $filesToAnalyzeService,
        private FilesAlreadyAnalyzedServiceInterface $filesAnalyzedService
    ) {}

    /**
     * Handles the analysis of uploaded files by categorizing them into documents to analyze
     * and documents already analyzed. Executes respective services to handle both categories.
     *
     * @param  AnalyzeFilesCommand  $command  The command containing a collection of uploaded documents.
     *
     * @throws Exception If an error occurs during processing.
     */
    public function handle(AnalyzeFilesCommand $command): void
    {
        $documents = $command->documents;

        $documentsAlreadyAnalyzed = [];

        $documentsToAnalyze = collect($documents)->map(function (TemporaryUploadedFile $file) use (&$documentsAlreadyAnalyzed) {
            $hash = hash_file('sha256', $file->getRealPath());

            $document = $this->repository->find($hash);

            if ($document) {
                $documentsAlreadyAnalyzed[$hash] = $file;

                return [];
            }

            return [
                $hash => $file,
            ];
        })
            ->filter()
            ->collapse()
            ->toArray();

        $this->filesToAnalyzeService->execute($documentsToAnalyze);
        $this->filesAnalyzedService->execute($documentsAlreadyAnalyzed);
    }
}
