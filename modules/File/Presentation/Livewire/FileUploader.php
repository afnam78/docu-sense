<?php

namespace Modules\File\Presentation\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toastable;
use Modules\File\Application\Commands\AnalyzeFilesCommand;
use Modules\File\Application\UseCases\AnalyzeFilesUseCase;

class FileUploader extends Component
{
    use Toastable, WithFileUploads;

    #[Validate(['files.*' => 'required|file|max:10240|mimes:pdf,jpeg,png,jpg'])]
    public $files;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('file::livewire.file-uploader');
    }

    public function save(AnalyzeFilesUseCase $useCase): void
    {
        try {
            $command = new AnalyzeFilesCommand($this->files);
            $useCase->handle($command);

            $this->info('Analizando archivos...');
        } catch (\Exception $e) {
            Log::error('Analyze Files Error '.$e->getMessage());

            $this->error('Error al analizar los archivos');
        }
    }

    public function getListeners(): array
    {
        $channel = 'echo-private:App.Models.User.'.auth()->id().',.file.analyzed';

        return [$channel => 'handleFileAnalyzed'];
    }

    public function handleFileAnalyzed(mixed $payload): void
    {
        $this->success('Archivo '.$payload['fileName'].' analizado.');
    }
}
