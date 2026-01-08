<?php

namespace Modules\Audit\Infrastructure\Databases\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = [
        'sheet_hash',
        'file_hash',
        'status',
        'arithmetic_coherence_status',
        'social_security_coherence_status',
        'heuristic_integrity_status',
        'fields_sanity_status',
        'arithmetic_coherence_details',
        'social_security_coherence_details',
        'heuristic_integrity_details',
        'fields_sanity_details',
    ];
}
