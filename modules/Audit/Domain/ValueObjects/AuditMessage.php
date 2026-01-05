<?php

namespace Modules\Audit\Domain\ValueObjects;

use Modules\Audit\Domain\Enums\StatusEnum;

final readonly class AuditMessage
{
    public function __construct(
        private StatusEnum $status,
        private string $title,
        private ?string $message = null,
    ) {}

    public function status(): StatusEnum
    {
        return $this->status;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function message(): ?string
    {
        return $this->message;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status->value,
            'title' => $this->title,
            'message' => $this->message,
        ];
    }
}
