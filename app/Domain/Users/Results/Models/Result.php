<?php

namespace App\Domain\Users\Results\Models;

use App\Domain\Admin\Controls\Models\Control;
use App\Domain\Admin\QuestionsAnswers\Models\Answer;
use App\Domain\Admin\QuestionsAnswers\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function control(): BelongsTo
    {
        return $this->belongsTo(Control::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @return BelongsTo
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }
}
