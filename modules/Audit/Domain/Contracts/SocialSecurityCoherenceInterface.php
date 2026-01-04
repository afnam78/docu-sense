<?php

namespace Modules\Audit\Domain\Contracts;

use Modules\Payslip\Domain\Entities\Payslip;

interface SocialSecurityCoherenceInterface
{
    public function execute(Payslip $payslip): array;
}
