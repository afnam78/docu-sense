<?php

namespace Modules\Payslip\Domain\Mappers;

use Modules\Payslip\Domain\ValueObjects\Concept;

class ConceptMapper
{
    public static function fromResponse(array $data): Concept
    {
        $amount = data_get($data, 'importe');
        $porcentaje = data_get($data, 'porcentaje');

        return new Concept(
            amount: (float) str_replace(',', '.', $amount ?? ''),
            concept: data_get($data, 'concepto', ''),
            percentage: (float) str_replace(',', '.', $porcentaje ?? ''),
        );
    }
}
