<?php

namespace Modules\Audit\Application\UseCases;

use Modules\Audit\Application\Commands\FindAuditCommand;
use Modules\Audit\Application\DTOs\AuditListDTO;
use Modules\Audit\Application\DTOs\PayslipDTO;
use Modules\Audit\Application\Results\FindAuditResult;
use Modules\Audit\Domain\Contracts\AuditRepositoryInterface;
use Modules\Audit\Domain\Exceptions\AuditNotFound;
use Modules\OpenAI\Domain\Contracts\OpenAIRepositoryInterface;
use Modules\Payslip\Domain\Mappers\PayslipMapper;

final readonly class FindAuditUseCase
{
    public function __construct(
        private AuditRepositoryInterface $repository,
        private OpenAIRepositoryInterface $openAIRepository,
    ) {}

    public function handle(FindAuditCommand $command): FindAuditResult
    {
        $openAIRequest = $this->openAIRepository->find($command->hash);

        if (! $openAIRequest) {
            throw new AuditNotFound($command->hash);
        }

        $content = $openAIRequest->content();
        $payslip = PayslipMapper::fromResponse($content);

        $auditList = $this->repository->find($command->hash);

        return new FindAuditResult(
            audit: AuditListDTO::fromObject($auditList),
            payslip: PayslipDTO::fromObject($payslip),
        );
    }
}
