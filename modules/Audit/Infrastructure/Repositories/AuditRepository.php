<?php

namespace Modules\Audit\Infrastructure\Repositories;

use Illuminate\Support\Facades\Log;
use Modules\Audit\Domain\Contracts\AuditRepositoryInterface;
use Modules\Audit\Domain\Entities\AuditList;
use Modules\Audit\Domain\Mappers\AuditListMapper;
use Modules\Audit\Infrastructure\Databases\Models\Audit;

class AuditRepository implements AuditRepositoryInterface
{
    public function create(AuditList $audit, string $fileHash): void
    {
        try {
            Audit::create([
                'file_hash' => $fileHash,
                'sheet_hash' => $audit->hash(),
                'status' => $audit->status()->value,
                'arithmetic_coherence_status' => $audit->arithmeticCoherence()->status()->value,
                'social_security_coherence_status' => $audit->socialSecurityCoherence()->status()->value,
                'heuristic_integrity_status' => $audit->heuristicIntegrity()->status()->value,
                'fields_sanity_status' => $audit->fieldsSanity()->status()->value,
                'arithmetic_coherence_details' => json_encode($audit->arithmeticCoherence()->toArray()),
                'social_security_coherence_details' => json_encode($audit->socialSecurityCoherence()->toArray()),
                'heuristic_integrity_details' => json_encode($audit->heuristicIntegrity()->toArray()),
                'fields_sanity_details' => json_encode($audit->fieldsSanity()->toArray()),
            ]);

        } catch (\Exception $e) {
            Log::error('Audit Repository Error: create method '.$e->getMessage());

            throw $e;
        }
    }

    public function find(string $sheetHash): ?AuditList
    {
        try {
            $auditRecord = Audit::where('sheet_hash', $sheetHash)->first();

            if (! $auditRecord) {
                return null;
            }

            return AuditListMapper::fromDB($auditRecord->toArray());

        } catch (\Exception $e) {
            Log::error('Audit Repository Error: find method '.$e->getMessage());

            throw $e;
        }
    }

    public function hashesWithAudit(array $hashes): array
    {
        try {
            return collect($hashes)->filter(fn ($hash) => Audit::select('sheet_hash')->where('sheet_hash', $hash)->first())->toArray();
        } catch (\Exception $e) {
            Log::error('Audit Repository Error: hashesWithAudit method '.$e->getMessage());

            throw $e;
        }
    }
}
