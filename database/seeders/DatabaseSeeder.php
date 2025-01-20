<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add one test user account
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        // Add one test admin account
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'testadmin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
    }
}