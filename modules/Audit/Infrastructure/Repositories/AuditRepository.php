<?php

namespace Modules\Audit\Infrastructure\Repositories;

use Illuminate\Support\Facades\Log;
use Modules\Audit\Domain\Contracts\AuditRepositoryInterface;
use Modules\Audit\Domain\Entities\Audit;
use Modules\Audit\Domain\ValueObjects\AuditMessage;

class AuditRepository implements AuditRepositoryInterface
{
    public function save(Audit $audit, string $fileHash): void
    {
        try {
            \Modules\Audit\Infrastructure\Databases\Models\Audit::create([
                'file_hash' => $fileHash,
                'arithmetic_coherence' => json_encode(array_map(fn(AuditMessage $item) => $item->toArray(), $audit->arithmeticCoherence()),true),
                'social_security_coherence' => json_encode(array_map(fn(AuditMessage $item) => $item->toArray(), $audit->socialSecurityCoherence()),true),
                'heuristic_integrity' => json_encode(array_map(fn(AuditMessage $item) => $item->toArray(), $audit->heuristicIntegrity()),true),
            ]);
        } catch (\Throwable $th) {
            Log::error('Audit Repository Error save method: '.$th->getMessage());
        }
    }
}
