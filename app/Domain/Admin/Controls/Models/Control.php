<?php

namespace App\Domain\Admin\Controls\Models;

use App\Domain\Admin\Files\Models\File;
use App\Domain\Users\Results\Models\Result;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Control extends Model
{
    use HasFactory;

    protected $perPage = 30;

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
