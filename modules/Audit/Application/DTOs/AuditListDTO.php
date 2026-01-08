<?php

namespace Modules\Audit\Application\DTOs;

use Modules\Audit\Domain\Entities\AuditList;
use Modules\Audit\Domain\Enums\StatusEnum;

final readonly class AuditListDTO
{
    public function __construct(
        public StatusEnum $status,
        public AuditItemDTO $arithmeticCoherence,
        public AuditItemDTO $socialSecurityCoherence,
        public AuditItemDTO $heuristicIntegrity,
        public AuditItemDTO $fieldsSanity
    ) {}

    public static function fromObject(AuditList $object): self
    {
        return new self(
            status: $object->status(),
            arithmeticCoherence: AuditItemDTO::fromObject($object->arithmeticCoherence()),
            socialSecurityCoherence: AuditItemDTO::fromObject($object->socialSecurityCoherence()),
            heuristicIntegrity: AuditItemDTO::fromObject($object->heuristicIntegrity()),
            fieldsSanity: AuditItemDTO::fromObject($object->fieldsSanity()),
        );
    }

    public function toArray(): array
    {
        return [
            'arithmetic_coherence' => array_map(
                fn (LogDTO $item) => $item->toArray(),
                $this->arithmeticCoherence->logs
            ),
            'social_security_coherence' => array_map(
                fn (LogDTO $item) => $item->toArray(),
                $this->socialSecurityCoherence->logs
            ),
            'heuristic_integrity' => array_map(
                fn (LogDTO $item) => $item->toArray(),
                $this->heuristicIntegrity->logs
            ),
            'fields_sanity' => array_map(
                fn (LogDTO $item) => $item->toArray(),
                $this->fieldsSanity->logs
            ),
        ];
    }
}
