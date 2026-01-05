<?php

namespace Modules\Audit\Application\Results;

use Modules\Audit\Application\DTOs\AuditDTO;

final readonly class FindAuditResult
{
    public function __construct(public AuditDTO $audit) {}
}
