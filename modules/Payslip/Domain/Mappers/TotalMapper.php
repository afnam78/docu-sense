<?php

namespace Modules\Payslip\Domain\Mappers;

use Modules\Payslip\Domain\ValueObjects\Total;

class TotalMapper
{
    public static function fromResponse(array $data): Total
    {
        $net = data_get($data, 'total_devengado');
        $taxes = data_get($data, 'total_deducir');
        $total = data_get($data, 'liquido_total');

        return new Total(
            net: (float) str_replace(',', '.', $net ?? ''),
            taxes: (float) str_replace(',', '.', $taxes ?? ''),
            total: (float) str_replace(',', '.', $total ?? ''),
        );
    }
}
