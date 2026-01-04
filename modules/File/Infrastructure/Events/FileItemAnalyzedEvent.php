<?php

namespace Modules\File\Infrastructure\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\File\Domain\Entities\File;

class FileItemAnalyzedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(private readonly File $file)
    {
        //
    }

    public function file(): File
    {
        return $this->file;
    }
}
