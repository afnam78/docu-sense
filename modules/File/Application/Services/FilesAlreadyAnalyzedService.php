<?php

namespace Modules\File\Application\Services;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\File\Application\Contracts\FilesAlreadyAnalyzedServiceInterface;
use Modules\File\Domain\Contracts\FileRepositoryInterface;

final readonly class FilesAlreadyAnalyzedService implements FilesAlreadyAnalyzedServiceInterface
{
    public function __construct(
        private FileRepositoryInterface $repository
    ) {}

    public function execute(array $documents): void
    {
        collect($documents)->each(function (TemporaryUploadedFile $file, string $hash) {
            $entity = $this->repository->findByTenant($hash, auth()->id());

            if (! $entity) {
                $this->repository->addAliase($hash, $file->getClientOriginalName(), auth()->id());
            }
        });
    }
}
