<?php

namespace Modules\Audit\Domain\Entities;

final readonly class Audit
{
    public function __construct(
        private array $arithmeticCoherence,
        private array $socialSecurityCoherence,
        private array $heuristicIntegrity,
        private array $fieldsSanity,
    ) {}

    public function arithmeticCoherence(): array
    {
        return $this->arithmeticCoherence;
    }

    public function socialSecurityCoherence(): array
    {
        return $this->socialSecurityCoherence;
    }

    public function heuristicIntegrity(): array
    {
        return $this->heuristicIntegrity;
    }

    public function fieldsSanity(): array
    {
        return $this->fieldsSanity;
    }
}
