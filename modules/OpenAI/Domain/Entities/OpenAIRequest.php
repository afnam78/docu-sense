<?php

namespace Modules\OpenAI\Domain\Entities;

use Illuminate\Support\Carbon;

final readonly class OpenAIRequest
{
    public function __construct(
        private string $id,
        private string $fileHash,
        private string $object,
        private Carbon $requestDate,
        private array $response,
        private bool $validStructure,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function fileHash(): string
    {
        return $this->fileHash;
    }

    public function response(): array
    {
        return $this->response;
    }

    public function content(): array
    {
        $content = data_get($this->response, 'choices.*.message.content', []) ?? [];
        $content = data_get($content, 0);

        return json_decode($content, true);
    }

    public function validStructure(): bool
    {
        return $this->validStructure;
    }

    public function object(): string
    {
        return $this->object;
    }

    public function requestDate(): Carbon
    {
        return $this->requestDate;
    }

    public function isCompleted(): bool
    {
        return $this->object === 'file.completed';
    }
}
