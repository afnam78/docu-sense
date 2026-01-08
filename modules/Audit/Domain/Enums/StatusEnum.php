<?php

namespace Modules\Audit\Domain\Enums;

enum StatusEnum: string
{
    case CRITICAL = 'CRITICAL';
    case WARNING = 'WARNING';
    case OK = 'OK';
    case INFO = 'INFO';

    public function badge(): string
    {
        return match ($this) {
            StatusEnum::WARNING => 'warning',
            StatusEnum::OK => 'success',
            StatusEnum::CRITICAL => 'danger',
            StatusEnum::INFO => 'info',
        };
    }

    public function isWarning(): bool
    {
        return $this === StatusEnum::WARNING;
    }

    public function isCritical(): bool
    {
        return $this === StatusEnum::CRITICAL;
    }

    public function isOk(): bool
    {
        return $this === StatusEnum::OK;
    }

    public function isInfo(): bool
    {
        return $this === StatusEnum::INFO;
    }

    public function priority(): int
    {
        return match ($this) {
            StatusEnum::CRITICAL => 3,
            StatusEnum::WARNING => 2,
            StatusEnum::INFO => 1,
            StatusEnum::OK => 0,
        };
    }

    public static function getStatusByPriority(array $statuses): self
    {
        usort($statuses, fn (StatusEnum $a, StatusEnum $b) => $b->priority() <=> $a->priority());

        return isset($statuses[0]) ? $statuses[0] : StatusEnum::OK;
    }
}
