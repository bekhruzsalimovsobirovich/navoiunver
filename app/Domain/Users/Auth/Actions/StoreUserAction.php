<?php

namespace App\Domain\Users\Auth\Actions;

use App\Domain\Users\Auth\DTO\StoreUserDTO;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StoreUserAction
{
    /**
     * @param StoreUserDTO $dto
     * @return User
     * @throws Exception
     */
    public function execute(StoreUserDTO $dto): User
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->firstname = $dto->getFirstname();
            $user->lastname = $dto->getLastname();
            $user->phone = $dto->getPhone();
            $user->region = $dto->getRegion();
            $user->city = $dto->getCity();
            $user->address = $dto->getAddress();
            $user->postal_code = $dto->getPostalCode();
            $user->email = $dto->getEmail();
            $user->password = Hash::make($dto->getPassword());
            $user->save();
            $user->syncRoles('user');
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $user;
    }
}
