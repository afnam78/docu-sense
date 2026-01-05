<?php

namespace Modules\Audit\Application\Commands;

final readonly class FindAuditCommand
{
    public function __construct(
        public string $hash,
    ) {}
}
