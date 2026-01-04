<?php

namespace Modules\Payslip\Domain\ValueObjects;

class Concept
{
    private float $amount;

    private string $concept;

    private float $percentage;

    public function __construct(float $amount, string $concept, float $percentage)
    {
        $this->amount = $amount;
        $this->concept = $concept;
        $this->percentage = $percentage;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function concept(): string
    {
        return $this->concept;
    }

    public function percentage(): float
    {
        return $this->percentage;
    }
}
