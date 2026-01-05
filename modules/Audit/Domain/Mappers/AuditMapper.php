<?php

namespace Modules\Audit\Domain\Mappers;

use Modules\Audit\Domain\Entities\Audit;

class AuditMapper
{
    public static function fromDB(array $data): Audit
    {
        $arithmeticCoherence = array_map(
            fn (array $item) => AuditMessageMapper::fromDB($item),
            json_decode($data['arithmetic_coherence'], true)
        );

        $socialSecurityCoherence = array_map(
            fn (array $item) => AuditMessageMapper::fromDB($item),
            json_decode($data['social_security_coherence'], true)
        );

        $heuristicIntegrity = array_map(
            fn (array $item) => AuditMessageMapper::fromDB($item),
            json_decode($data['heuristic_integrity'], true)
        );

        return new Audit(
            arithmeticCoherence: $arithmeticCoherence,
            socialSecurityCoherence: $socialSecurityCoherence,
            heuristicIntegrity: $heuristicIntegrity
        );
    }
}
