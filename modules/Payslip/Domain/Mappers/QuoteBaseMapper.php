<?php

namespace Modules\Payslip\Domain\Mappers;

use Modules\Payslip\Domain\ValueObjects\QuoteBase;

class QuoteBaseMapper
{
    public static function fromResponse(array $data): QuoteBase
    {
        $irpf = data_get($data, 'irpf');
        $professionalContingencies = data_get($data, 'at_y_ep');
        $commonContingencies = data_get($data, 'contingencias_comunes');

        return new QuoteBase(
            irpf: (float) str_replace(',', '.', $irpf ?? ''),
            professionalContingencies: (float) str_replace(',', '.', $professionalContingencies ?? ''),
            commonContingencies: (float) str_replace(',', '.', $commonContingencies ?? ''),
        );
    }
}
