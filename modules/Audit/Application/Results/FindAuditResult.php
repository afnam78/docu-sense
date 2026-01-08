<?php

namespace Modules\Audit\Application\Results;

use Modules\Audit\Application\DTOs\AuditListDTO;
use Modules\Audit\Application\DTOs\PayslipDTO;

final readonly class FindAuditResult
{
    public function __construct(
        public AuditListDTO $audit,
        public PayslipDTO $payslip,
    ) {}
}
