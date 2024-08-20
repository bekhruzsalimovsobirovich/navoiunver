<?php

namespace App\Domain\Admin\Lessons\Models;

use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use App\Domain\Admin\Courses\Models\Course;
use App\Domain\Admin\CourseSubjects\Models\CourseSubject;
use App\Domain\Admin\Files\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $perPage = 20;

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function course_plan(): BelongsTo
    {
        return $this->belongsTo(CoursePlan::class)->without('course');
    }

    public function course_subject(): BelongsTo
    {
        return $this->belongsTo(CourseSubject::class)->without('course','course_plan');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
