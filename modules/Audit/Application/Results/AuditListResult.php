<?php

namespace Modules\Audit\Application\Results;

final readonly class AuditListResult
{
    public function __construct(
        public array $hashes,
        public string $fileName,
    ) {}
}
