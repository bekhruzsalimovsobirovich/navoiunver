<?php

namespace App\Domain\Admin\Files\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['filename', 'path','type'];

    public function fileable()
    {
        return $this->morphTo();
    }
}
