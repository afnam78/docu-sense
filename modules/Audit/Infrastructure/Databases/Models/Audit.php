<?php

namespace Modules\Audit\Infrastructure\Databases\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\File\Infrastructure\Databases\Models\File;

class Audit extends Model
{
    protected $fillable = [
        'file_hash',
        'arithmetic_coherence',
        'social_security_coherence',
        'heuristic_integrity',
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_hash', 'hash');
    }
}
