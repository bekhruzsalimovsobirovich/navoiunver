<?php

namespace App\Domain\Admin\Questions\Models;

use App\Domain\Admin\Controls\Models\Control;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $perPage = 20;

    /**
     * @return HasOne
     */
    public function control(): HasOne
    {
        return $this->hasOne(Control::class);
    }
}
