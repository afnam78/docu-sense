<?php

namespace Modules\Audit\Application\Commands;

final readonly class AuditListCommand
{
    public function __construct(
        public string $hash,
        public int $tenantId
    ) {}
}
