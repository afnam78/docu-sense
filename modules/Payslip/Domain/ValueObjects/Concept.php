<?php

namespace Modules\Payslip\Domain\ValueObjects;

use Modules\Shared\Domain\ValueObjects\Money;

class Concept
{
    private Money $amount;

    private string $concept;

    private float $percentage;

    public function __construct(Money $amount, string $concept, float $percentage)
    {
        $this->amount = $amount;
        $this->concept = $concept;
        $this->percentage = $percentage;
    }

    public function amount(): Money
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
