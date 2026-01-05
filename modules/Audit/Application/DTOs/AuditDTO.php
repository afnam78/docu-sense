<?php

namespace Modules\Audit\Application\DTOs;

use Modules\Audit\Domain\Entities\Audit;
use Modules\Audit\Domain\ValueObjects\AuditMessage;

final readonly class AuditDTO
{
    public function __construct(
        /**
         * @var AuditMessageDTO[]
         */
        public array $arithmeticCoherence,
        /**
         * @var AuditMessageDTO[]
         */
        public array $socialSecurityCoherence,
        /**
         * @var AuditMessageDTO[]
         */
        public array $heuristicIntegrity,
    ) {}

    public static function fromObject(Audit $object): self
    {
        return new self(
            array_map(fn (AuditMessage $item) => AuditMessageDTO::fromObject($item), $object->arithmeticCoherence()),
            array_map(fn (AuditMessage $item) => AuditMessageDTO::fromObject($item), $object->socialSecurityCoherence()),
            array_map(fn (AuditMessage $item) => AuditMessageDTO::fromObject($item), $object->heuristicIntegrity()),
        );
    }

    public function toArray(): array
    {
        return [
            'arithmetic_coherence' => array_map(
                fn (AuditMessageDTO $item) => $item->toArray(),
                $this->arithmeticCoherence
            ),
            'social_security_coherence' => array_map(
                fn (AuditMessageDTO $item) => $item->toArray(),
                $this->socialSecurityCoherence
            ),
            'heuristic_integrity' => array_map(
                fn (AuditMessageDTO $item) => $item->toArray(),
                $this->heuristicIntegrity
            ),
        ];
    }
}
