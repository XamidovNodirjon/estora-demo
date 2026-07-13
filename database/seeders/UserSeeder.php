<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name'     => 'dev',
            'username' => 'developer',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id'  => Role::where('name', 'dev')->first()->id,
        ];

        User::create($user);
    }
}
