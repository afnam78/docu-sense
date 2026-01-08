<?php

namespace Modules\Audit\Domain\Entities;

use Modules\Audit\Domain\Enums\StatusEnum;

final readonly class AuditList
{
    public function __construct(
        private string     $hash,
        private StatusEnum $status,
        private AuditItem  $arithmeticCoherence,
        private AuditItem  $socialSecurityCoherence,
        private AuditItem  $heuristicIntegrity,
        private AuditItem  $fieldsSanity,
    ) {}

    public function arithmeticCoherence(): AuditItem
    {
        return $this->arithmeticCoherence;
    }

    public function socialSecurityCoherence(): AuditItem
    {
        return $this->socialSecurityCoherence;
    }

    public function heuristicIntegrity(): AuditItem
    {
        return $this->heuristicIntegrity;
    }

    public function fieldsSanity(): AuditItem
    {
        return $this->fieldsSanity;
    }

    public function hash(): string
    {
        return $this->hash;
    }

    public function status(): StatusEnum
    {
        return $this->status;
    }
}
