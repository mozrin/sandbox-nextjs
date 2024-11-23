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
        // Create Test User - Mozrin

        User::factory()->create([
            'name' => 'Mozrin Caer',
            'email' => 'mozrin@mozrin.com',
        ]);

        User::factory()->count(99)->create(); // Create Random Users
    }
}
