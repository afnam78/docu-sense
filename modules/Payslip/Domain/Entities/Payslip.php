<?php

namespace Modules\Payslip\Domain\Entities;

use Modules\Payslip\Domain\ValueObjects\Company;
use Modules\Payslip\Domain\ValueObjects\Period;
use Modules\Payslip\Domain\ValueObjects\QuoteBase;
use Modules\Payslip\Domain\ValueObjects\Total;
use Modules\Payslip\Domain\ValueObjects\Worker;

class Payslip
{
    public function __construct(
        private Company $company,
        private Worker $worker,
        private Period $period,
        private Total $totals,
        private array $accruals,
        private array $deductions,
        private QuoteBase $quoteBase
    ) {}

    public function company(): Company
    {
        return $this->company;
    }

    public function worker(): Worker
    {
        return $this->worker;
    }

    public function period(): Period
    {
        return $this->period;
    }

    public function totals(): Total
    {
        return $this->totals;
    }

    public function accruals(): array
    {
        return $this->accruals;
    }

    public function deductions(): array
    {
        return $this->deductions;
    }

    public function quoteBase(): QuoteBase
    {
        return $this->quoteBase;
    }
}
