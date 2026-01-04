<?php

namespace Modules\Payslip\Domain\Mappers;

use Illuminate\Support\Carbon;
use Modules\Payslip\Domain\ValueObjects\Period;

class PeriodMapper
{
    public static function fromResponse(array $data): Period
    {
        return new Period(
            startDate: Carbon::createFromFormat('d/m/Y', data_get($data, 'fecha_inicio')),
            endDate: Carbon::createFromFormat('d/m/Y', data_get($data, 'fecha_fin')),
            totalDays: data_get($data, 'total_dias'),
        );
    }
}
