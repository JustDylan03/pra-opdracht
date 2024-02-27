<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Team::factory(10)->create();
        \App\Models\Competition::factory(10)->create();
        \App\Models\Goal::factory(10)->create();

        // Users with specific values
        // Admin with is_admin set to true (1)
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make("pass"),
            'is_admin' => 1
        ]);

        // Basic sample user
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make("pass"),
        ]);
    }
}

