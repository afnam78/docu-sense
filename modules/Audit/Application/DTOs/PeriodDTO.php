<?php

namespace Modules\Audit\Application\DTOs;

use Illuminate\Support\Carbon;
use Modules\Payslip\Domain\ValueObjects\Period;

final readonly class PeriodDTO
{
    public Carbon $startDate;

    public Carbon $endDate;

    public int $totalDays;

    public function __construct(Carbon $startDate, Carbon $endDate, int $totalDays)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->totalDays = $totalDays;
    }

    public static function fromObject(Period $period): self
    {
        return new self($period->startDate(), $period->endDate(), $period->totalDays());
    }

    public function toArray(): array
    {
        return [
            'Inicio' => $this->startDate->format('d/m/Y'),
            'Fin' => $this->endDate->format('d/m/Y'),
            'Días totales' => $this->totalDays,
        ];
    }
}
