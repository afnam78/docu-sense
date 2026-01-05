<?php

namespace Modules\OpenAI\Domain\Mappers;

use Illuminate\Support\Carbon;
use Modules\OpenAI\Domain\Entities\OpenAIRequest;

final readonly class OpenAIRequestMapper
{
    public static function fromDB(array $data): OpenAIRequest
    {
        return new OpenAIRequest(
            id: $data['id'],
            fileHash: $data['file_hash'],
            object: $data['object'],
            requestDate: Carbon::createFromFormat('Y-m-d H:i:s', $data['request_date']),
            response: json_decode($data['response'], true),
            validStructure: $data['valid_structure'],
        );
    }
}
