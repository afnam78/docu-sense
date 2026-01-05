<?php

namespace Modules\Audit\Application\Results;

use Modules\Audit\Application\DTOs\AuditDTO;
use Modules\Audit\Application\DTOs\PayslipDTO;

final readonly class FindAuditResult
{
    public function __construct(
        public AuditDTO $audit,
        public PayslipDTO $payslip,
        public string $fileName,
    ) {}
}
