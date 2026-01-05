<?php

namespace Modules\Audit\Application\DTOs;

use Modules\Payslip\Domain\ValueObjects\Concept;

final class ConceptDTO
{
    public float $amount;

    public string $concept;

    public float $percentage;

    public function __construct(float $amount, string $concept, float $percentage)
    {
        $this->amount = $amount;
        $this->concept = $concept;
        $this->percentage = $percentage;
    }

    public static function fromObject(Concept $concept): self
    {
        return new self($concept->amount()->toDecimal(), $concept->concept(), $concept->percentage());
    }

    public function toString(): string
    {
        $sprintFormat = $this->percentage ? '%s: %.2f€ (%.2f%%)' : '%s: %.2f€';

        return sprintf(
            $sprintFormat,
            $this->concept,
            $this->amount,
            $this->percentage
        );
    }
}
