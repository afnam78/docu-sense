<?php

namespace Modules\Audit\Domain\Mappers;

use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\AuditMessage;

class AuditMessageMapper
{
    public static function fromDB(array $data): AuditMessage
    {
        return new AuditMessage(
            status: StatusEnum::from($data['status']),
            title: $data['title'],
            message: $data['message'],
        );
    }
}
