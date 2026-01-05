<?php

namespace Modules\Payslip\Domain\ValueObjects;

use Modules\Shared\Domain\ValueObjects\Money;

class Total
{
    private ?Money $net;

    private ?Money $taxes;

    private ?Money $total;

    public function __construct(?Money $net, ?Money $taxes, ?Money $total)
    {
        $this->net = $net;
        $this->taxes = $taxes;
        $this->total = $total;
    }

    public function net(): ?Money
    {
        return $this->net;
    }

    public function taxes(): ?Money
    {
        return $this->taxes;
    }

    public function total(): ?Money
    {
        return $this->total;
    }
}
