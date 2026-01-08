<?php

namespace Modules\Audit\Domain\Mappers;

use Modules\Audit\Domain\Entities\AuditList;
use Modules\Audit\Domain\Enums\StatusEnum;

class AuditListMapper
{
    public static function fromDB(array $data): AuditList
    {
        return new AuditList(
            hash: $data['sheet_hash'],
            status: StatusEnum::from($data['status']),
            arithmeticCoherence: AuditItemMapper::fromDB($data['arithmetic_coherence_details']),
            socialSecurityCoherence: AuditItemMapper::fromDB($data['social_security_coherence_details']),
            heuristicIntegrity: AuditItemMapper::fromDB($data['heuristic_integrity_details']),
            fieldsSanity: AuditItemMapper::fromDB($data['fields_sanity_details'])
        );
    }
}
