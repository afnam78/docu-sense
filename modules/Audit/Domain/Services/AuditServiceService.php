<?php

namespace Modules\Audit\Domain\Services;

use Modules\Audit\Domain\Contracts\ArithmeticCoherenceInterface;
use Modules\Audit\Domain\Contracts\AuditServiceInterface;
use Modules\Audit\Domain\Contracts\HeuristicIntegrityInterface;
use Modules\Audit\Domain\Contracts\SocialSecurityCoherenceInterface;
use Modules\Audit\Domain\Entities\Audit;
use Modules\Payslip\Domain\Entities\Payslip;

final readonly class AuditServiceService implements AuditServiceInterface
{
    public function __construct(
        private ArithmeticCoherenceInterface $arithmeticCoherence,
        private SocialSecurityCoherenceInterface $socialSecurityCoherence,
        private HeuristicIntegrityInterface $heuristicIntegrity,
    ) {}

    public function execute(Payslip $payslip): Audit
    {
        $arithmeticConsistency = $this->arithmeticCoherence->execute($payslip);
        $socialSecurityCoherence = $this->socialSecurityCoherence->execute($payslip);
        $heuristicIntegrity = $this->heuristicIntegrity->execute($payslip);

        return new Audit($arithmeticConsistency, $socialSecurityCoherence, $heuristicIntegrity);
    }
}
