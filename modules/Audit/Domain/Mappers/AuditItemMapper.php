<?php

namespace Modules\Audit\Domain\Mappers;

use Modules\Audit\Domain\Entities\AuditItem;
use Modules\Audit\Domain\Enums\StatusEnum;

class AuditItemMapper
{
    public static function fromDB(string $auditItem): AuditItem
    {
        $data = json_decode($auditItem, true);
        $status = data_get($data, 'status', null);
        $status = $status ? StatusEnum::from($status) : StatusEnum::OK;

        return new AuditItem(
            $status,
            array_map(fn (array $item) => LogMapper::fromDB($item), data_get($data, 'logs', []) ?? [])
        );
    }
}
