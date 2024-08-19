<?php

namespace App\Domain\Admin\CourseSubjects\Repositories;

use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use App\Domain\Admin\Courses\Models\Course;
use App\Domain\Admin\CourseSubjects\Models\CourseSubject;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CourseSubjectRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return CourseSubject::query()
            ->with('course','course_plan')
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Collection|Builder[]
     */
    public function getAll(): array|Collection
    {
        return CourseSubject::query()
            ->orderByDesc('id')
            ->get();
    }
}
