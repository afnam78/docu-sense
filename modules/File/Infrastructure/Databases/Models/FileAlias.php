<?php

namespace Modules\File\Infrastructure\Databases\Models;

use Illuminate\Database\Eloquent\Model;

class FileAlias extends Model
{
    protected $table = 'file_aliases';

    protected $fillable = ['file_hash', 'user_id', 'name'];

    public function file(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(File::class, 'file_hash', 'hash');
    }
}
