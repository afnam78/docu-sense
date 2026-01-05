<?php

namespace Modules\Payslip\Domain\ValueObjects;

use Illuminate\Support\Carbon;

class Period
{
    private ?Carbon $startDate;

    private ?Carbon $endDate;

    private ?int $totalDays;

    public function __construct(?Carbon $startDate, ?Carbon $endDate, ?int $totalDays)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->totalDays = $totalDays;
    }

    public function startDate(): ?Carbon
    {
        return $this->startDate;
    }

    public function endDate(): ?Carbon
    {
        return $this->endDate;
    }

    public function totalDays(): ?int
    {
        return $this->totalDays;
    }
}
