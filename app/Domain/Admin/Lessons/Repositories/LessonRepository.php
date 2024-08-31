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
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder[]
     */
    public function getLessonCourse($course_id): array|\Illuminate\Database\Eloquent\Collection
    {
        return Lesson::query()
            ->where('course_id',$course_id)
            ->orderByDesc('id')
            ->get();
    }
}
