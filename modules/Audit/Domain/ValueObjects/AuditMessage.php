<?php

namespace Modules\Audit\Domain\ValueObjects;

use Modules\Audit\Domain\Enums\StatusEnum;

final readonly class AuditMessage
{
    public function __construct(
        private StatusEnum $status,
        private string $message,
    ) {}

    public function status(): StatusEnum
    {
        return $this->status;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status->value,
            'message' => $this->message,
        ];
    }
}
