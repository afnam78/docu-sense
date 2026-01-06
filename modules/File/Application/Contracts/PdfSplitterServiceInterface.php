<?php

namespace Modules\File\Application\Contracts;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

interface PdfSplitterServiceInterface
{
    public function execute(TemporaryUploadedFile $file, string $originalHash): array;
}
