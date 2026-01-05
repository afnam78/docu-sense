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

    public string $hash;

    public function render()
    {
        return view('audit::livewire.audit-detail');
    }

    public function mount(string $hash, FindAuditUseCase $useCase): void
    {
        try {
            $this->hash = $hash;
            $command = new FindAuditCommand($hash);
            $audit = $useCase->handle($command)->audit->toArray();

            $this->arithmeticCoherence = $audit['arithmetic_coherence'];
            $this->socialSecurityCoherence = $audit['social_security_coherence'];
            $this->heuristicIntegrity = $audit['heuristic_integrity'];
        } catch (AuditNotFound $e) {
            abort(404, 'Audit not found.');
        } catch (\Exception $e) {
            Log::error('Error mounting AuditDetail component: '.$e->getMessage());
            abort(500, 'An error occurred while loading the audit details.');
        }
    }
}
