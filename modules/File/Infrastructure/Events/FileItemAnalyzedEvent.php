<?php

namespace Modules\File\Infrastructure\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\OpenAI\Infrastructure\Databases\Models\OpenAiRequest;

class FileItemAnalyzedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(private readonly OpenAiRequest $openAIRequest)
    {
        //
    }

    public function openAIRequest(): OpenAiRequest
    {
        return $this->openAIRequest;
    }
}
