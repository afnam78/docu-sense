<?php

namespace Modules\Audit\Application\DTOs;

use Modules\Audit\Domain\Entities\AuditItem;
use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\Log;

class AuditItemDTO
{
    public function __construct(
        public StatusEnum $status,
        public array $logs
    ) {}

    public static function fromObject(AuditItem $object): self
    {
        return new self(
            status: $object->status(),
            logs: collect($object->logs())
                ->map(fn (Log $log) => LogDTO::fromObject($log))
                ->toArray()
        );
    }
}
