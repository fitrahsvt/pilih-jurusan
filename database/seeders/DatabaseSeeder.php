<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Role::create([
            'name' => 'user'
        ]);

        User::create([
            'role_id' => 1,
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user@gmail.com'),
            'email_verified_at' => now(),
            'remember_token' => 'UJIBfO1gra',
        ]);

        Food::create([
            'name' => 'Rendang',
            'price' => 23000,
            'description' => 'Lorem ipsum dolor amet.',
        ]);

        Food::factory(20)->create();
        User::factory(20)->create();
    }
}
