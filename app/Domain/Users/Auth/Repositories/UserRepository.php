<?php

namespace App\Domain\Users\Auth\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return User::query()
            ->orderByDesc('id')
            ->paginate();
    }
}
