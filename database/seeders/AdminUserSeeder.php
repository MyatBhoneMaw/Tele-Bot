<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->givePermissionTo(['create-user', 'edit-user' ,'delete-user']);

        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );

        $user->assignRole('admin');
    }
}
