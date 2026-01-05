<?php

namespace Modules\OpenAI\Infrastructure\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\OpenAI\Domain\Contracts\OpenAIServiceInterface;
use Modules\OpenAI\Infrastructure\Databases\Models\OpenAiRequest;
use OpenAI\Laravel\Facades\OpenAI;

final readonly class OpenAIService implements OpenAIServiceInterface
{
    public function __construct() {}

    public function analyzeDocument(string $hash, string $base64): OpenAiRequest
    {
        try {
            $requestRegistered = OpenAiRequest::where('file_hash', $hash)->first();

            if ($requestRegistered) {
                return $requestRegistered;
            }

            $response = OpenAI::chat()->create([
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
                                'text' => 'Extrae toda la información de esta nómina siguiendo el esquema. '.
                                'REGLAS DE FORMATO CRÍTICAS: '.
                                '1. Todas las FECHAS deben usar el formato d/m/Y (ejemplo: 01/09/2023). '.
                                '2. Los PORCENTAJES deben ser strings numéricos con COMA como separador decimal (ejemplo: 2,00 o 15,50). '.
                                'El valor del campo file_hash será: '.$hash.'. '.
                                'Rellena valid_structure con true si se cumplen los campos requeridos.',
                            ],
                            ['type' => 'image_url', 'image_url' => ['url' => $base64]],
                        ],
                    ],
                ],
                'response_format' => [
                    'type' => 'json_schema',
                    'json_schema' => [
                        'name' => 'nomina_extraction',
                        'strict' => true,
                        'schema' => [
                            'type' => 'object',
                            'properties' => [
                                'file_hash' => ['type' => 'string'],
                                'valid_structure' => ['type' => 'boolean'],
                                'empresa' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'nombre' => ['type' => 'string'],
                                        'cif' => ['type' => 'string'],
                                        'ccc' => ['type' => 'string'],
                                    ],
                                    'required' => ['nombre', 'cif', 'ccc'],
                                    'additionalProperties' => false,
                                ],
                                'trabajador' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'nombre' => ['type' => 'string'],
                                        'dni' => ['type' => 'string'],
                                        'naf' => ['type' => 'string'],
                                        'grupo_cotizacion' => ['type' => 'string'],
                                        'antiguedad' => ['type' => 'string', 'description' => 'Fecha en formato d/m/Y'],
                                    ],
                                    'required' => ['nombre', 'dni', 'naf', 'grupo_cotizacion', 'antiguedad'],
                                    'additionalProperties' => false,
                                ],
                                'periodo' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'fecha_inicio' => ['type' => 'string', 'description' => 'Fecha en formato d/m/Y'],
                                        'fecha_fin' => ['type' => 'string', 'description' => 'Fecha en formato d/m/Y'],
                                        'total_dias' => ['type' => 'string', 'description' => 'Fecha en formato d/m/Y'],
                                    ],
                                    'required' => ['fecha_inicio', 'fecha_fin', 'total_dias'],
                                    'additionalProperties' => false,
                                ],
                                'devengos' => [
                                    'type' => 'array',
                                    'items' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'concepto' => ['type' => 'string'],
                                            'importe' => ['type' => 'string'],
                                        ],
                                        'required' => ['concepto', 'importe'],
                                        'additionalProperties' => false,
                                    ],
                                ],
                                'deducciones' => [
                                    'type' => 'array',
                                    'items' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'concepto' => ['type' => 'string'],
                                            'importe' => ['type' => 'string'],
                                            'porcentaje' => ['type' => 'string', 'description' => 'Número con decimal separado por coma'],
                                        ],
                                        'required' => ['concepto', 'importe', 'porcentaje'],
                                        'additionalProperties' => false,
                                    ],
                                ],
                                'totales' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'total_devengado' => ['type' => 'string'],
                                        'total_deducir' => ['type' => 'string'],
                                        'liquido_total' => ['type' => 'string'],
                                    ],
                                    'required' => ['total_devengado', 'total_deducir', 'liquido_total'],
                                    'additionalProperties' => false,
                                ],
                                'bases_cotizacion' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'contingencias_comunes' => ['type' => 'string'],
                                        'at_y_ep' => ['type' => 'string'],
                                        'irpf' => ['type' => 'string'],
                                    ],
                                    'required' => ['contingencias_comunes', 'at_y_ep', 'irpf'],
                                    'additionalProperties' => false,
                                ],
                            ],
                            'required' => [
                                'file_hash',
                                'empresa',
                                'trabajador',
                                'periodo',
                                'devengos',
                                'deducciones',
                                'totales',
                                'bases_cotizacion',
                                'valid_structure',
                            ],
                            'additionalProperties' => false,
                        ],
                    ],
                ]]);

            $responseJson = json_encode($response->toArray());
            Storage::disk('local')->put($hash.'.json', $responseJson);

            $content = $response->toArray()['choices'][0]['message']['content'];
            $contentJson = json_decode($content);

            return OpenAiRequest::create([
                'file_hash' => $hash,
                'id' => $response->id,
                'object' => $response->object,
                'request_date' => Carbon::createFromTimestamp($response->created)->toDateTimeString(),
                'response' => $responseJson,
                'valid_structure' => (bool) data_get($contentJson, 'valid_structure'),
            ]);
        } catch (\Exception $e) {
            Log::error('Analyze Document Error: '.$e->getMessage());

            throw $e;
        }
    }
}
