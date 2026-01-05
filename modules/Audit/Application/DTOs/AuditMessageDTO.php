<?php

namespace Modules\Audit\Application\DTOs;

use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\AuditMessage;

final readonly class AuditMessageDTO
{
    public function __construct(
        public string $message,
        public StatusEnum $status,
    ) {}

    public static function fromObject(AuditMessage $object): self
    {
        return new self(
            message: $object->message(),
            status: $object->status(),
        );
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'status' => $this->status,
        ];
    }
}
