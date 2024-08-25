<?php

namespace App\Domain\Admin\QuestionsAnswers\Models;

use App\Domain\Admin\Controls\Models\Control;
use App\Domain\Admin\QuestionsAnswers\Models\Answer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $fillable=[
        'control_id',
        'name',
        'status',
        'active',
    ];

    protected $perPage = 30;

    /**
     * @return BelongsTo
     */
    public function control(): BelongsTo
    {
        return $this->belongsTo(Control::class);
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @return HasMany
     */
    public function answersRandom(): HasMany
    {
        return $this->hasMany(Answer::class)->inRandomOrder();
    }
}
