<?php

namespace Modules\File\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;
use Modules\File\Infrastructure\Databases\Models\FileAlias;

class FileList extends Component
{
    use Toastable, WithPagination;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('file::livewire.file-list', [
            'files' => FileAlias::with('file.request')->where('user_id', auth()->id())->orderByDesc('created_at')->paginate(50),
        ]);
    }

    public function getListeners(): array
    {
        $channel = 'echo-private:App.Models.User.'.auth()->id().',.file.analyzed';

        return [$channel => 'handleFileAnalyzed'];
    }

    public function handleFileAnalyzed(mixed $payload): void
    {
        $this->render();
        $this->success('Nuevo archivo analizado');
    }
}
