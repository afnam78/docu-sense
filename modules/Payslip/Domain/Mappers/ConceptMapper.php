<?php

namespace Modules\Payslip\Domain\Mappers;

use Modules\Payslip\Domain\ValueObjects\Concept;
use Modules\Shared\Domain\ValueObjects\Money;

class ConceptMapper
{
    public static function fromResponse(array $data): Concept
    {
        $amount = data_get($data, 'importe');
        $percentage = data_get($data, 'porcentaje');

        return new Concept(
            amount: new Money((float) str_replace(',', '.', $amount ?? '0.00')),
            concept: data_get($data, 'concepto', ''),
            percentage: (float) str_replace(',', '.', $percentage ?? ''),
        );
    }
}
