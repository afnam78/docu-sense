<?php

namespace Modules\Payslip\Domain\Mappers;

use Modules\Payslip\Domain\ValueObjects\QuoteBase;
use Modules\Shared\Domain\ValueObjects\Money;

class QuoteBaseMapper
{
    public static function fromResponse(array $data): QuoteBase
    {
        $irpf = data_get($data, 'irpf');
        $professionalContingencies = data_get($data, 'at_y_ep');
        $commonContingencies = data_get($data, 'contingencias_comunes');

        return new QuoteBase(
            irpf: new Money((float) str_replace(',', '.', $irpf ?? '')),
            professionalContingencies: new Money((float) str_replace(',', '.', $professionalContingencies ?? '')),
            commonContingencies: new Money((float) str_replace(',', '.', $commonContingencies ?? '')),
        );
    }
}
