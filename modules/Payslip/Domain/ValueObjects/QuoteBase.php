<?php

namespace Modules\Payslip\Domain\ValueObjects;

use Modules\Shared\Domain\ValueObjects\Money;

class QuoteBase
{
    private Money $irpf;

    private Money $professionalContingencies;

    private Money $commonContingencies;

    public function __construct(Money $irpf, Money $professionalContingencies, Money $commonContingencies)
    {
        $this->irpf = $irpf;
        $this->professionalContingencies = $professionalContingencies;
        $this->commonContingencies = $commonContingencies;
    }

    public function irpf(): Money
    {
        return $this->irpf;
    }

    public function professionalContingencies(): Money
    {
        return $this->professionalContingencies;
    }

    public function commonContingencies(): Money
    {
        return $this->commonContingencies;
    }
}
