<?php

namespace App\Domain\Admin\Controls\Repositories;

use App\Domain\Admin\Controls\Models\Control;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ControlRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return Control::query()
            ->with('files')
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Control::query()
            ->orderByDesc('id')
            ->get();
    }
}
