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
     * @return LengthAwarePaginator
     */
    public function getLessonCourse($course_id): LengthAwarePaginator
    {
        return Lesson::query()
            ->where('course_id',$course_id)
            ->orderByDesc('id')
            ->paginate();
    }
}
