<?php

namespace Modules\File\Infrastructure\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileAnalyzed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

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

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('App.Models.User.'.$this->userId);
    }

    public function broadcastAs(): string
    {
        return 'file.analyzed';
    }
}
