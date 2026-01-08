<?php

namespace Modules\File\Infrastructure\Databases\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Audit\Infrastructure\Databases\Models\Audit;
use Modules\OpenAI\Infrastructure\Databases\Models\OpenAiRequest;

class File extends Model
{
    protected $primaryKey = 'hash';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['hash', 'mimetype', 'base64', 'status', 'json_response', 'payslip_response', 'analyze_date', 'file_hash'];

    public function aliases(): HasMany
    {
        return $this->hasMany(FileAlias::class, 'file_hash', 'hash');
    }

    public function request(): HasOne
    {
        return $this->hasOne(OpenAiRequest::class, 'file_hash', 'hash');
    }

    public function sheets(): BelongsToMany
    {
        return $this->belongsToMany(
            File::class,
            'files_sheets',
            'file_hash',
            'sheet_hash',
            'hash',
            'hash'
        );
    }

    public function audits(): HasMany
    {
        return $this->hasMany(Audit::class, 'file_hash', 'hash');
    }

    public function file(): BelongsToMany
    {
        return $this->belongsToMany(
            File::class,
            'files_sheets',
            'sheet_hash',
            'file_hash',
            'hash',
            'hash'
        );
    }
}
