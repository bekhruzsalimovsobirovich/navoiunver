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
}
