<?php

namespace Modules\Payslip\Domain\ValueObjects;

use Illuminate\Support\Carbon;

class Worker
{
    private string $name;

    private string $nif;

    private string $ccc;

    private Carbon $seniorityDate;

    private string $quotationGroup;

    public function __construct(string $name, string $nif, string $ccc, Carbon $seniorityDate, string $quotationGroup)
    {
        $this->name = $name;
        $this->nif = $nif;
        $this->ccc = $ccc;
        $this->seniorityDate = $seniorityDate;
        $this->quotationGroup = $quotationGroup;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function nif(): string
    {
        return $this->nif;
    }

    public function ccc(): string
    {
        return $this->ccc;
    }

    public function seniorityDate(): Carbon
    {
        return $this->seniorityDate;
    }

    public function quotationGroup(): string
    {
        return $this->quotationGroup;
    }
}
