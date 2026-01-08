<?php

namespace Modules\Audit\Application\UseCases;

use Modules\Audit\Application\Commands\AuditListCommand;
use Modules\Audit\Application\Results\AuditListResult;
use Modules\Audit\Domain\Contracts\AuditRepositoryInterface;
use Modules\Audit\Domain\Exceptions\AuditNotFound;
use Modules\File\Domain\Contracts\FileRepositoryInterface;
use Modules\File\Domain\Entities\File;

final readonly class AuditListUseCase
{
    public function __construct(
        private FileRepositoryInterface $fileRepository,
        private AuditRepositoryInterface $auditRepository,
    ) {}

    public function handle(AuditListCommand $command): AuditListResult
    {
        $file = $this->fileRepository->findByTenant($command->hash, $command->tenantId);

        if (! $file) {
            throw new AuditNotFound($command->hash);
        }

        $hashes = [];

        if ($file->mimeType() === 'pdf') {
            $sheets = $this->fileRepository->sheets($file->hash());

            $hashes = collect($sheets)->map(fn (File $sheet) => $sheet->hash())->toArray();
        } else {
            $hashes[] = $file->hash();
        }

        return new AuditListResult(
            hashes: $this->auditRepository->hashesWithAudit($hashes),
            fileName: $file->name()
        );
    }
}
