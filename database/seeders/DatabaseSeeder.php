<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user if it doesn't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@aurablog.com'],
            [
                'name' => 'Aura Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

    // Create 5 random users
    User::factory(5)->create();

    // Remove existing placeholder blogs to avoid duplicates
    Blog::query()->delete();

    // Create 25 highly realistic blogs assigned to random users
    Blog::factory(25)->create();
    }
}
