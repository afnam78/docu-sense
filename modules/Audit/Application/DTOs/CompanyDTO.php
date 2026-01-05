<?php

namespace Modules\Audit\Application\DTOs;

use Modules\Payslip\Domain\ValueObjects\Company;

final readonly class CompanyDTO
{
    public function __construct(
        public string $name,
        public string $cif,
        public string $ccc,
    ) {}

    public static function fromObject(Company $company): self
    {
        return new self(
            name: $company->name(),
            cif: $company->cif(),
            ccc: $company->ccc(),
        );
    }

    public function toArray(): array
    {
        return [
            'Nombre' => $this->name,
            'CIF' => $this->cif,
            'CCC' => $this->ccc,
        ];
    }
}
