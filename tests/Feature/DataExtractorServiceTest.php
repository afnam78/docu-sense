<?php

namespace Tests\Payslip\Domain\Services;

use Modules\Audit\Domain\Contracts\AuditServiceInterface;
use Modules\Payslip\Domain\Mappers\PayslipMapper;

test('execute', function () {
    $json = '{    "empresa": {"nombre": "SOCIEDAD ESPAÑOLA ALQUILER GARANTIZADO, S.A.", "cif": "A70405808", "ccc": ""},    "trabajador": {"nombre": "AMIN ALAMIN AFNAN", "dni": "60100717T", "naf": "08/14579705-89", "grupo_cotizacion": "6831", "antiguedad": "03/04/2024"},    "periodo": {"fecha_inicio": "01/12/2025", "fecha_fin": "31/12/2025", "total_dias": "30"},    "devengos": [        {"concepto": "*Salario Base", "importe": "1361,07"},        {"concepto": "*MEJORA VOLUNTARIA", "importe": "493,52"},        {"concepto": "*DIETAS TRIBUTA", "importe": "22,00"},        {"concepto": "*Plus Polivalencia", "importe": "58,49"},        {"concepto": "*P.P NAVIDAD", "importe": "118,30"},        {"concepto": "*P.P VERANO", "importe": "118,30"}    ],    "deducciones": [        {"concepto": "Cotización Contingencias Comunes", "importe": "102,42", "porcentaje": "4,70"},        {"concepto": "Cotización Mecanismo Equidad Intergeneracional", "importe": "2,83", "porcentaje": "0,13"},        {"concepto": "Cotización Formación Profesional", "importe": "2,18", "porcentaje": "0,10"},        {"concepto": "Cotización Desempleo", "importe": "33,78", "porcentaje": "1,55"},        {"concepto": "Tributación IRPF", "importe": "350,94", "porcentaje": "16,16%"}    ],    "totales": {"total_devengado": "2179,08", "total_deducir": "499,55", "liquido_total": "1672,13"},    "bases_cotizacion": {"contingencias_comunes": "2179,08", "at_y_ep": "2179,08", "irpf": "2171,68"}}';

    $data = json_decode($json, true);
    $payslip = PayslipMapper::fromResponse($data);

    $service = app(AuditServiceInterface::class);

    $result = $service->execute($payslip);
});
