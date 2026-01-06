<?php

namespace Modules\File\Infrastructure\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileAnalyzed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(private readonly int $userId, private readonly string $fileHash, public readonly string $fileName)
    {
        //
    }

    public function fileHash(): string
    {
        return $this->fileHash;
    }
}
