<?php

namespace Modules\Payslip\Domain\ValueObjects;

class Company
{
    private string $name;

    private string $cif;

    private string $ccc;

    public function __construct(string $name, string $cif, string $ccc)
    {
        $this->name = $name;
        $this->cif = $cif;
        $this->ccc = $ccc;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function cif(): string
    {
        return $this->cif;
    }

    public function ccc(): string
    {
        return $this->ccc;
    }
}
