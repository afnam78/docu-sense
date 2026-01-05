<?php

namespace Modules\Audit\Application\UseCases;

use Modules\Audit\Application\Commands\FindAuditCommand;
use Modules\Audit\Application\DTOs\AuditDTO;
use Modules\Audit\Application\Results\FindAuditResult;
use Modules\Audit\Domain\Contracts\AuditRepositoryInterface;
use Modules\Audit\Domain\Exceptions\AuditNotFound;

final readonly class FindAuditUseCase
{
    public function __construct(private AuditRepositoryInterface $repository) {}

    public function handle(FindAuditCommand $command): FindAuditResult
    {
        $object = $this->repository->find($command->hash);

        if (! $object) {
            throw new AuditNotFound($command->hash);
        }

        return new FindAuditResult(AuditDTO::fromObject($object));
    }
}
