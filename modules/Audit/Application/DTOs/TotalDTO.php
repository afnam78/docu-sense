<?php

namespace Modules\Audit\Application\DTOs;

use Modules\Payslip\Domain\ValueObjects\Total;

final readonly class TotalDTO
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

    public static function fromObject(Total $totals): self
    {
        return new self($totals->net(), $totals->taxes(), $totals->total());
    }

    public function toArray(): array
    {
        return [
            'Bruto' => $this->net.'€',
            'Impuestos' => $this->taxes.'€',
            'Neto' => $this->total.'€',
        ];
    }
}
