<?php

namespace Modules\Audit\Domain\Contracts;

use Modules\Audit\Domain\Entities\Audit;

interface AuditRepositoryInterface
{
    public function save(Audit $audit, string $fileHash): void;
}
