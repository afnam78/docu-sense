<?php

namespace Modules\Audit\Domain\Services;

use Modules\Audit\Domain\Contracts\ArithmeticCoherenceInterface;
use Modules\Audit\Domain\Contracts\AuditRepositoryInterface;
use Modules\Audit\Domain\Contracts\HeuristicIntegrityInterface;
use Modules\Audit\Domain\Contracts\PayslipAuditServiceInterface;
use Modules\Audit\Domain\Contracts\PayslipFieldsSanityServiceInterface;
use Modules\Audit\Domain\Contracts\SocialSecurityCoherenceInterface;
use Modules\Audit\Domain\Entities\AuditList;
use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\Log;
use Modules\Payslip\Domain\Entities\Payslip;

final readonly class PayslipAuditServiceService implements PayslipAuditServiceInterface
{
    public function __construct(
        private ArithmeticCoherenceInterface $arithmeticCoherence,
        private SocialSecurityCoherenceInterface $socialSecurityCoherence,
        private HeuristicIntegrityInterface $heuristicIntegrity,
        private PayslipFieldsSanityServiceInterface $payslipFieldsSanityService,
        private AuditRepositoryInterface $auditRepository,
    ) {}

    public function generate(Payslip $payslip, string $fileHash, string $hash): void
    {
        $arithmeticCoherence = $this->arithmeticCoherence->execute($payslip);
        $socialSecurityCoherence = $this->socialSecurityCoherence->execute($payslip);
        $heuristicIntegrity = $this->heuristicIntegrity->execute($payslip);
        $fieldsSanity = $this->payslipFieldsSanityService->execute($payslip);

        $auditList = new AuditList(
            hash: $hash,
            status: StatusEnum::getStatusByPriority(array_map(fn (Log $log) => $log->status(), [...$arithmeticCoherence->logs(), ...$socialSecurityCoherence->logs(), ...$heuristicIntegrity->logs(), ...$fieldsSanity->logs()])),
            arithmeticCoherence: $arithmeticCoherence,
            socialSecurityCoherence: $socialSecurityCoherence,
            heuristicIntegrity: $heuristicIntegrity,
            fieldsSanity: $fieldsSanity,
        );

        $this->auditRepository->create($auditList, $fileHash);
    }
}
