<?php

namespace Modules\Audit\Domain\Contracts;

use Modules\Audit\Domain\Entities\AuditItem;
use Modules\Payslip\Domain\Entities\Payslip;

interface ArithmeticCoherenceInterface
{
    public function execute(Payslip $payslip): AuditItem;
}
