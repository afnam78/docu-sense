<?php

namespace Modules\Payslip\Domain\Mappers;

use Modules\Payslip\Domain\Entities\Payslip;

class PayslipMapper
{
    public static function fromResponse(array $data): Payslip
    {
        return new Payslip(
            company: CompanyMapper::fromResponse($data['empresa']),
            worker: WorkerMapper::fromResponse($data['trabajador']),
            period: PeriodMapper::fromResponse($data['periodo']),
            totals: TotalMapper::fromResponse($data['totales']),
            accruals: array_map(fn ($item) => ConceptMapper::fromResponse($item), $data['devengos'] ?? []),
            deductions: array_map(fn ($item) => ConceptMapper::fromResponse($item), $data['deducciones'] ?? []),
            quoteBase: QuoteBaseMapper::fromResponse($data['bases_cotizacion']),
        );
    }

    public static function isValidStructure(array $data): bool
    {
        return isset(
            $data['empresa'],
            $data['trabajador'],
            $data['periodo'],
            $data['totales'],
            $data['bases_cotizacion']
        ) && WorkerMapper::isValidStructure($data['trabajador'])
          && PeriodMapper::isValidStructure($data['periodo']);
    }
}
