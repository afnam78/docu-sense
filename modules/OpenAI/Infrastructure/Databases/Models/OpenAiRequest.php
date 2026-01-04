<?php

namespace Modules\OpenAI\Infrastructure\Databases\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\File\Infrastructure\Databases\Models\File;

class OpenAiRequest extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'file_hash',
        'object',
        'request_date',
        'response',
        'valid_structure'
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_hash', 'hash');
    }
}
