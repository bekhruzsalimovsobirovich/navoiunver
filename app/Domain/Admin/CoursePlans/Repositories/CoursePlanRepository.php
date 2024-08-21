<?php

namespace App\Domain\Admin\CoursePlans\Repositories;

use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use App\Domain\Admin\Courses\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CoursePlanRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return CoursePlan::query()
            ->with('course')
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Collection|Builder[]
     */
    public function getAll(): array|Collection
    {
        return CoursePlan::query()
            ->orderByDesc('id')
            ->get();
    }

    /**
     * @param $course_id
     * @return Builder[]|Collection
     */
    public function findCoursePlanWithCourseId($course_id): Collection|array
    {
        return CoursePlan::query()
            ->where('course_id',$course_id)
            ->get();
    }
}
