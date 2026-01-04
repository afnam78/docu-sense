<?php

namespace Modules\Payslip\Domain\ValueObjects;

class QuoteBase
{
    private float $irpf;

    private float $professionalContingencies;

    private float $commonContingencies;

    public function __construct(float $irpf, float $professionalContingencies, float $commonContingencies)
    {
        $this->irpf = $irpf;
        $this->professionalContingencies = $professionalContingencies;
        $this->commonContingencies = $commonContingencies;
    }

    public function irpf(): float
    {
        return $this->irpf;
    }

    public function professionalContingencies(): float
    {
        return $this->professionalContingencies;
    }

    public function commonContingencies(): float
    {
        return $this->commonContingencies;
    }
}
