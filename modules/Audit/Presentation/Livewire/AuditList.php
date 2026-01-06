<?php

namespace Modules\Audit\Presentation\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Modules\Audit\Application\Commands\AuditListCommand;
use Modules\Audit\Application\UseCases\AuditListUseCase;
use Modules\Audit\Domain\Exceptions\AuditNotFound;

class AuditList extends Component
{
    public array $hashes = [];

    public string $fileName;

    public string $selectedHash;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('audit::livewire.audit-list');
    }

    public function mount(string $hash, AuditListUseCase $useCase): void
    {
        try {
            $command = new AuditListCommand($hash, auth()->id());
            $result = $useCase->handle($command);

            $this->hashes = $result->hashes;
            $this->fileName = $result->fileName;
            $this->setSelectedHash(collect($this->hashes)->first());

        } catch (AuditNotFound $e) {
            abort(404);
        } catch (\Exception $e) {
            Log::error('Audit List Livewire Error: mount method '.$e->getMessage());

            abort(500);
        }
    }

    public function setSelectedHash(string $hash): void
    {
        $this->selectedHash = $hash;
    }
}
