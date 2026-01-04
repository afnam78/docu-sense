<?php

namespace Modules\Payslip\Domain\Mappers;

use Modules\Payslip\Domain\ValueObjects\Company;

class CompanyMapper
{
    public static function fromResponse(array $data): Company
    {
        return new Company(
            name: data_get($data, 'nombre', ''),
            ccc: data_get($data, 'ccc', ''),
            cif: data_get($data, 'cif', ''),
        );
    }
}
