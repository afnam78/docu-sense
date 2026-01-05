<?php

namespace Modules\Payslip\Domain\Mappers;

use Modules\Payslip\Domain\ValueObjects\Total;
use Modules\Shared\Domain\ValueObjects\Money;

class TotalMapper
{
    public static function fromResponse(array $data): Total
    {
        $net = data_get($data, 'total_devengado');
        $taxes = data_get($data, 'total_deducir');
        $total = data_get($data, 'liquido_total');

        return new Total(
            net: new Money((float) str_replace(',', '.', $net ?? '0.00')),
            taxes: new Money((float) str_replace(',', '.', $taxes ?? '0.00')),
            total: new Money((float) str_replace(',', '.', $total ?? '0.00')),
        );
    }
}
