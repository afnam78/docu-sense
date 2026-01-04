<?php

namespace Modules\Payslip\Domain\Mappers;

use Illuminate\Support\Carbon;
use Modules\Payslip\Domain\ValueObjects\Worker;

class WorkerMapper
{
    public static function fromResponse(array $data): Worker
    {
        $seniorityDate = data_get($data, 'antiguedad');

        return new Worker(
            name: data_get($data, 'nombre', ''),
            nif: data_get($data, 'dni', ''),
            ccc: data_get($data, 'naf', ''),
            seniorityDate: Carbon::createFromFormat('d/m/Y', $seniorityDate),
            quotationGroup: data_get($data, 'grupo_cotizacion', ''),
        );
    }
}
