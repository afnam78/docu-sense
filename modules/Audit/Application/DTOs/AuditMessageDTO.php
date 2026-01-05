<?php

namespace Modules\Audit\Application\DTOs;

use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\AuditMessage;

final readonly class AuditMessageDTO
{
    public function __construct(
        public StatusEnum $status,
        public string $title,
        public ?string $message,
    ) {}

    public static function fromObject(AuditMessage $object): self
    {
        return new self(
            status: $object->status(),
            title: $object->title(),
            message: $object->message(),
        );
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'status' => $this->status,
            'title' => str($this->title)->limit(60),
        ];
    }
}
