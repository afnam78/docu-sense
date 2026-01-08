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
    public function __construct(private readonly int $userId, private readonly string $fileHash, private readonly string $sheetHash, public readonly string $fileName)
    {
        //
    }

    public function fileHash(): string
    {
        return $this->fileHash;
    }

    public function sheetHash(): string
    {
        return $this->sheetHash;
    }

    public function userId(): int
    {
        return $this->userId;
    }
}
