<?php

namespace App\Models;

use App\Domain\Admin\Lessons\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LessonUser extends Model
{
    use HasFactory;

    protected $table = 'lesson_user';

    public function lesson_users(): HasMany
    {
        return $this->hasMany(Lesson::class,'id','lesson_id');
    }
}
