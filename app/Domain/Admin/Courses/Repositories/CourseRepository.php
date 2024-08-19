<?php

namespace App\Domain\Admin\Courses\Repositories;

use App\Domain\Admin\Courses\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CourseRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return Course::query()
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Collection|Builder[]
     */
    public function getAll(): array|Collection
    {
        return Course::query()
            ->orderByDesc('id')
            ->get();
    }
}
