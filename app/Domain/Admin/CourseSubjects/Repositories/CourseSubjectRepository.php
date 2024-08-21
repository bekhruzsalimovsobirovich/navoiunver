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

    /**
     * @param $course_id
     * @param $course_plan_id
     * @return Builder[]|Collection
     */
    public function findCourseSubjectWithCourseIdCoursePlanId($course_id,$course_plan_id): Collection|array
    {
        return CourseSubject::query()
            ->where('course_id',$course_id)
            ->where('course_plan_id',$course_plan_id)
            ->get();
    }
}
