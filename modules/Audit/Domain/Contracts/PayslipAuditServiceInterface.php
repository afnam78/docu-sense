<?php

namespace Modules\Audit\Domain\Contracts;

use Modules\Audit\Domain\Entities\Audit;
use Modules\Payslip\Domain\Entities\Payslip;

interface PayslipAuditServiceInterface
{
    public function generate(Payslip $payslip): Audit;
}
