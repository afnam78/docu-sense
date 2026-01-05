<?php

namespace Modules\Audit\Domain\Contracts;

use Modules\Payslip\Domain\Entities\Payslip;

interface PayslipFieldsSanityServiceInterface
{
    public function execute(Payslip $payslip): array;
}
