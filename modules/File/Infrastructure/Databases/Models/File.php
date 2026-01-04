<?php

namespace Modules\File\Infrastructure\Databases\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $primaryKey = 'hash';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['hash', 'mimetype', 'base64', 'status', 'json_response', 'payslip_response'];

    public function aliases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FileAlias::class, 'file_hash', 'hash');
    }
}
