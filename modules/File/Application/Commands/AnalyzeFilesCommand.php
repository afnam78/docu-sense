<?php

namespace Modules\File\Application\Commands;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AnalyzeFilesCommand
{
    public function __construct(
        /**
         * @var TemporaryUploadedFile[]
         */
        public array $documents
    ) {}
}
