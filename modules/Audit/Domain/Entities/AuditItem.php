<?php

namespace Modules\Audit\Domain\Entities;

use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\Log;

final class AuditItem
{
    public function __construct(
        private StatusEnum $status,
        private array $logs,
    ) {}

    public function status(): StatusEnum
    {
        return $this->status;
    }

    public function logs(): array
    {
        return $this->logs;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status->value,
            'logs' => collect($this->logs)->map(fn (Log $logs) => $logs->toArray())->toArray(),
        ];
    }
}
