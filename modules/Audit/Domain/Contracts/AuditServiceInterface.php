<?php

namespace Modules\Audit\Domain\Contracts;

use Modules\Audit\Domain\Entities\Audit;
use Modules\Payslip\Domain\Entities\Payslip;

interface AuditServiceInterface
{
    public function execute(Payslip $payslip): Audit;
}
