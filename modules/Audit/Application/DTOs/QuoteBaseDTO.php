<?php

namespace Modules\Audit\Application\DTOs;

use Modules\Payslip\Domain\ValueObjects\QuoteBase;

final readonly class QuoteBaseDTO
{
    public ?float $irpf;

    public ?float $professionalContingencies;

    public ?float $commonContingencies;

    public function __construct(?float $irpf, ?float $professionalContingencies, ?float $commonContingencies)
    {
        $this->irpf = $irpf;
        $this->professionalContingencies = $professionalContingencies;
        $this->commonContingencies = $commonContingencies;
    }

    public static function fromObject(QuoteBase $quoteBase): self
    {
        return new self($quoteBase->irpf()->toDecimal(), $quoteBase->professionalContingencies()->toDecimal(), $quoteBase->commonContingencies()->toDecimal());
    }

    public function toArray(): array
    {
        return [
            'IRPF' => $this->irpf,
            'Contingencias profesionales' => $this->professionalContingencies,
            'Contingencias comunes' => $this->commonContingencies,
        ];
    }
}
