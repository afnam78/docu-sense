<?php

namespace Modules\Audit\Domain\Contracts;

use Modules\Payslip\Domain\Entities\Payslip;

interface ArithmeticCoherenceInterface
{
    public function execute(Payslip $payslip): array;
}
