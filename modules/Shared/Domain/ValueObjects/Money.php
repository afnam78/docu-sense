<?php

namespace Modules\Shared\Domain\ValueObjects;

class Money
{
    private int $amount;

    public function __construct(float $amount)
    {
        $this->amount = (int) round($amount * 100);
    }

    public function equals(Money $other): bool
    {
        return $this->amount === $other->amount();
    }

    public function subtract(Money $other): Money
    {
        return new self(($this->amount - $other->amount()) / 100);
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function toDecimal(): float
    {
        return $this->amount / 100;
    }
}
