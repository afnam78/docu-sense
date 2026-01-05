<?php

namespace Modules\Audit\Presentation\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Modules\Audit\Application\Commands\FindAuditCommand;
use Modules\Audit\Application\UseCases\FindAuditUseCase;
use Modules\Audit\Domain\Exceptions\AuditNotFound;

class AuditDetail extends Component
{
    public array $arithmeticCoherence;

    public array $socialSecurityCoherence;

    public array $heuristicIntegrity;

    public array $fieldsSanity;

    public string $hash;

    public array $payslip;

    public string $fileName;

    public function render()
    {
        return view('audit::livewire.audit-detail');
    }

    public function mount(string $hash, FindAuditUseCase $useCase): void
    {
        try {
            $this->hash = $hash;
            $command = new FindAuditCommand($hash);
            $result = $useCase->handle($command);

            $this->fileName = $result->fileName;
            $audit = $result->audit->toArray();
            $this->payslip = $result->payslip->toArray();

            $this->arithmeticCoherence = data_get($audit, 'arithmetic_coherence', []);
            $this->socialSecurityCoherence = data_get($audit, 'social_security_coherence', []);
            $this->heuristicIntegrity = data_get($audit, 'heuristic_integrity', []);
            $this->fieldsSanity = data_get($audit, 'fields_sanity', []);
        } catch (AuditNotFound $e) {
            abort(404, 'Audit not found.');
        } catch (\Exception $e) {
            throw $e;
            Log::error('Error mounting AuditDetail component: '.$e->getMessage());
            abort(500, 'An error occurred while loading the audit details.');
        }
    }
}
