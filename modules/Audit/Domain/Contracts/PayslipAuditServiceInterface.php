<?php

namespace Modules\Audit\Domain\Contracts;

use Modules\Payslip\Domain\Entities\Payslip;

interface PayslipAuditServiceInterface
{
    public function generate(Payslip $payslip, string $fileHash, string $hash): void;
}
