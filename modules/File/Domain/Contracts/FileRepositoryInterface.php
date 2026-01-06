<?php

namespace Modules\File\Domain\Contracts;

use Modules\File\Domain\Entities\File;

interface FileRepositoryInterface
{
    public function find(string $hash): ?File;

    public function analyzable(string $hash): bool;

    public function findByTenant(string $hash, int $userId): ?File;

    public function markAsDone(string $hash): void;

    public function markAsProcessing(string $hash): void;

    public function markAsToAnalyze(string $hash): void;

    public function markAsError(string $hash): void;

    public function update(File $file): void;

    public function sheets(string $fileHash): array;
}
