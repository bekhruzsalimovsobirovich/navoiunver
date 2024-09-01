<?php

namespace App\Domain\Admin\Lessons\Repositories;

use App\Domain\Admin\Lessons\Models\Lesson;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LessonRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return Lesson::query()
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @param $course_id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getLessonCourse($course_id)
    {
        return Lesson::query()
            ->with('course','course_plan','course_subject','files')
            ->where('course_id',$course_id)
            ->get()
            ->groupBy('course_plan.name');
    }
}
