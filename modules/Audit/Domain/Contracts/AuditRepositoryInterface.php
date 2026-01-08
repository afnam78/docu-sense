<?php

namespace Modules\Audit\Domain\Contracts;

use Modules\Audit\Domain\Entities\AuditList;

interface AuditRepositoryInterface
{
    public function create(AuditList $audit, string $fileHash): void;

    public function find(string $sheetHash): ?AuditList;
}
