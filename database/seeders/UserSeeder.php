<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::updateOrCreate(['name' => 'admin']);
        $role_user = Role::updateOrCreate(['name' => 'user']);

        $admin = User::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'phone' => 998901234567,
            'region' => 'Bukhara',
            'city' => 'Bukhara',
            'address' => 'Muhammad Iqbol',
            'postal_code' => 0,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $user = User::create([
            'firstname' => 'User',
            'lastname' => 'User',
            'phone' => 998907654321,
            'region' => 'Bukhara',
            'city' => 'Bukhara',
            'address' => 'Muhammad Iqbol',
            'postal_code' => 0,
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
        ]);

        $admin->syncRoles($role_admin->name);
        $user->syncRoles($role_user->name);
    }
}
