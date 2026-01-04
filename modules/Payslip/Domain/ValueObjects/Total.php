<?php

namespace Modules\Payslip\Domain\ValueObjects;

class Total
{
    public float $net;

    public float $taxes;

    public float $total;

    public function __construct(float $net, float $taxes, float $total)
    {
        $this->net = $net;
        $this->taxes = $taxes;
        $this->total = $total;
    }

    public function net(): float
    {
        return $this->net;
    }

    public function taxes(): float
    {
        return $this->taxes;
    }

    public function total(): float
    {
        return $this->total;
    }
}
