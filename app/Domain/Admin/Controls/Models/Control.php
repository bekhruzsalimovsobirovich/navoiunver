<?php

namespace App\Domain\Admin\Controls\Models;

use App\Domain\Admin\Files\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    use HasFactory;

    protected $perPage = 30;

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
