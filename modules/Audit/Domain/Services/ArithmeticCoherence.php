<?php

namespace Modules\Audit\Domain\Services;

use Modules\Audit\Domain\Contracts\ArithmeticCoherenceInterface;
use Modules\Audit\Domain\Entities\AuditItem;
use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\Log;
use Modules\Payslip\Domain\Entities\Payslip;
use Modules\Payslip\Domain\ValueObjects\Concept;

final readonly class ArithmeticCoherence implements ArithmeticCoherenceInterface
{
    public function execute(Payslip $payslip): AuditItem
    {
        $logs = [];

        $accrualSum = collect($payslip->accruals())->sum(fn (Concept $item) => $item->amount()->amount());
        $extractedAccrualSum = $payslip->totals()->net()?->amount();

        if ($accrualSum !== $extractedAccrualSum) {
            $logs[] = new Log(
                status: StatusEnum::CRITICAL,
                title: 'Cálculo incorrecto de devengos'
            );
        } else {
            $logs[] = new Log(
                status: StatusEnum::OK,
                title: 'Cálculo correcto de devengos'
            );
        }

        $deductionSum = collect($payslip->deductions())->sum(fn (Concept $item) => $item->amount()->amount());
        $extractedDeductionSum = $payslip->totals()->taxes()?->amount();

        if ($deductionSum !== $extractedDeductionSum) {
            $logs[] = new Log(
                status: StatusEnum::CRITICAL,
                title: 'Cálculo incorrecto de deducciones'
            );
        } else {
            $logs[] = new Log(
                status: StatusEnum::OK,
                title: 'Cálculo correcto de deducciones'
            );
        }

        $netTotal = ($accrualSum - $deductionSum);
        $extractedNetTotal = $payslip->totals()->total()?->amount();

        if ($netTotal !== $extractedNetTotal) {
            $logs[] = new Log(
                status: StatusEnum::CRITICAL,
                title: 'Cálculo incorrecto del total neto'
            );
        } else {
            $logs[] = new Log(
                status: StatusEnum::OK,
                title: 'Cálculo correcto del total neto'
            );
        }

        return new AuditItem(
            status: StatusEnum::getStatusByPriority(array_map(fn (Log $log) => $log->status(), $logs)),
            logs: $logs,
        );
    }
}
