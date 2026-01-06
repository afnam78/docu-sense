<?php

namespace Modules\Audit\Application\UseCases;

use Modules\Audit\Application\Commands\FindAuditCommand;
use Modules\Audit\Application\DTOs\AuditDTO;
use Modules\Audit\Application\DTOs\PayslipDTO;
use Modules\Audit\Application\Results\FindAuditResult;
use Modules\Audit\Domain\Contracts\PayslipAuditServiceInterface;
use Modules\Audit\Domain\Exceptions\AuditNotFound;
use Modules\OpenAI\Domain\Contracts\OpenAIRepositoryInterface;
use Modules\Payslip\Domain\Mappers\PayslipMapper;

final readonly class FindAuditUseCase
{
    public function __construct(
        private OpenAIRepositoryInterface $openAIRepository,
        private PayslipAuditServiceInterface $payslipAuditService,
    ) {}

    public function handle(FindAuditCommand $command): FindAuditResult
    {
        $openAIRequest = $this->openAIRepository->find($command->hash);

        if (! $openAIRequest) {
            throw new AuditNotFound($command->hash);
        }

        $content = $openAIRequest->content();
        $payslip = PayslipMapper::fromResponse($content);

        $audit = $this->payslipAuditService->generate($payslip);

        return new FindAuditResult(
            audit: AuditDTO::fromObject($audit),
            payslip: PayslipDTO::fromObject($payslip),
        );
    }
}
