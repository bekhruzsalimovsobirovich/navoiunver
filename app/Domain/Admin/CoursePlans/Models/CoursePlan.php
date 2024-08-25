<?php

namespace App\Domain\Admin\CoursePlans\Models;

use App\Domain\Admin\Courses\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoursePlan extends Model
{
    use HasFactory;

    protected $perPage = 30;

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
