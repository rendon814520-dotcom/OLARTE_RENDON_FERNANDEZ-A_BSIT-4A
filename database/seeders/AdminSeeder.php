<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin 1',
            'email' => 'testadmin1@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'), // Ensure to hash the password
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);
    }
}
