<?php

namespace Modules\Audit\Domain\Services;

use Modules\Audit\Domain\Contracts\HeuristicIntegrityInterface;
use Modules\Audit\Domain\Enums\StatusEnum;
use Modules\Audit\Domain\ValueObjects\AuditMessage;
use Modules\Payslip\Domain\Entities\Payslip;
use Modules\Shared\Domain\ValueObjects\NIF;

final readonly class HeuristicIntegrity implements HeuristicIntegrityInterface
{
    public function execute(Payslip $payslip): array
    {
        return array_merge(
            $this->nifValidations($payslip),
            $this->temporalSanity($payslip)
        );
    }

    private function nifValidations(Payslip $payslip): array
    {
        $audits = [];

        $employee = $payslip->worker();

        if (! NIF::isValidDniOrNie($employee->nif())) {
            $audits[] = new AuditMessage(
                status: StatusEnum::CRITICAL,
                title: 'NIF mal formado'
            );
        } else {
            $audits[] = new AuditMessage(
                status: StatusEnum::INFO,
                title: 'Formato de NIF correcto. (no se comprueba su validez)'
            );
        }

        if (! NIF::isValidCIF($payslip->company()->cif())) {
            $audits[] = new AuditMessage(
                status: StatusEnum::CRITICAL,
                title: 'CIF de la empresa inválido'
            );
        } else {
            $audits[] = new AuditMessage(
                status: StatusEnum::INFO,
                title: 'Formato de CIF correcto. (no se comprueba su validez)'
            );
        }

        return $audits;
    }

    private function temporalSanity(Payslip $payslip): array
    {
        $audit = [];

        $period = $payslip->period();
        $startDate = $period->startDate();
        $endDate = $period->endDate();
        $extractedDays = $period->totalDays();

        if ($startDate->greaterThan($endDate)) {

            return [
                new AuditMessage(
                    status: StatusEnum::CRITICAL,
                    title: 'Incoherencia en fechas del período',
                    message: 'La fecha de inicio del período es posterior a la fecha de fin'
                ),
            ];
        } else {
            $audit[] = new AuditMessage(
                status: StatusEnum::OK,
                title: 'Fechas del período coherentes'
            );
        }

        if ($endDate->greaterThan(now()->addMonth())) {
            $audit[] = new AuditMessage(
                status: StatusEnum::WARNING,
                title: 'Fecha futura detectada',
                message: 'La nómina indica una fecha futura. Posible error de lectura.'
            );
        } else {
            $audit[] = new AuditMessage(
                status: StatusEnum::OK,
                title: 'Fecha del período dentro de rango esperado'
            );
        }

        $calendarDays = $startDate->diffInDays($endDate) + 1;
        if ($extractedDays !== 30 && $extractedDays !== $calendarDays) {
            $audit[] = new AuditMessage(
                status: StatusEnum::WARNING,
                title: 'Incoherencia en días del período',
                message: "Los días extraídos ({$extractedDays}) no coinciden con el calendario ({$calendarDays})."
            );
        } else {
            $audit[] = new AuditMessage(
                status: StatusEnum::OK,
                title: 'Días del período coherentes'
            );
        }

        return $audit;
    }
}
