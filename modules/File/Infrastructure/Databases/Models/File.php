<?php

namespace Modules\File\Infrastructure\Databases\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Audit\Infrastructure\Databases\Models\Audit;

class File extends Model
{
    protected $primaryKey = 'hash';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['hash', 'mimetype', 'base64', 'status', 'json_response', 'payslip_response', 'analyze_date'];

    public function aliases(): HasMany
    {
        return $this->hasMany(FileAlias::class, 'file_hash', 'hash');
    }

    public function audit(): HasOne
    {
        return $this->hasOne(Audit::class, 'file_hash', 'hash');
    }
}
