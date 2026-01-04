<?php

namespace Modules\OpenAI\Infrastructure\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CompletionRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $base64Image,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/chat/completions';
    }

    public function defaultBody(): array
    {
        return [
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Eres un extractor de datos contables. Tu salida debe ser exclusivamente un JSON válido.',
                ],
                [
                    'role' => 'user',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Extrae toda la información de esta nómina siguiendo exactamente esta estructura JSON.

REGLAS DE FORMATO:
1. FECHAS: Todas las fechas en formato d/m/Y (ej: 01/01/2026).
2. PORCENTAJES: En el array de "deducciones", añade el campo "porcentaje". Debe ser un número decimal usando la COMA como separador (ej: "4,70"). Si un concepto no tiene porcentaje, devuelve "".
3. IMPORTES: Usa siempre la coma para los decimales en todos los campos numéricos.

Estructura:
{
    "empresa": {"nombre": "", "cif": "", "ccc": ""},
    "trabajador": {"nombre": "", "dni": "", "naf": "", "grupo_cotizacion": "", "antiguedad": ""},
    "periodo": {"fecha_inicio": "", "fecha_fin": "", "total_dias": ""},
    "devengos": [{"concepto": "", "importe": ""}],
    "deducciones": [{"concepto": "", "importe": "", "porcentaje": ""}],
    "totales": {"total_devengado": "", "total_deducir": "", "liquido_total": ""},
    "bases_cotizacion": {"contingencias_comunes": "", "at_y_ep": "", "irpf": ""}
}',
                        ],
                        [
                            'type' => 'image_url',
                            'image_url' => [
                                'url' => $this->base64Image,
                            ],
                        ],
                    ],
                ],
            ],
            'response_format' => [
                'type' => 'json_object',
            ],
        ];

    }
}
