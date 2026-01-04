<?php

namespace Modules\File\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\File\Infrastructure\Databases\Models\FileAlias;

class FileList extends Component
{
    use WithPagination;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('file::livewire.file-list', [
            'files' => FileAlias::with('file')->where('user_id', auth()->id())->paginate(50),
        ]);
    }
}
