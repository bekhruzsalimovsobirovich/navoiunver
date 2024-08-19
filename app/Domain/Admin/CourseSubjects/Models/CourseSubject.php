<?php

namespace App\Domain\Admin\CourseSubjects\Models;

use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use App\Domain\Admin\Courses\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseSubject extends Model
{
    use HasFactory;

    protected $perPage = 20;

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function course_plan(): BelongsTo
    {
        return $this->belongsTo(CoursePlan::class);
    }
}
