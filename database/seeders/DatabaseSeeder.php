<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::factory()->create([
            'name' => 'admin',
        ]);
        Role::factory()->create([
            'name' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'role_id' => 1,
        ]);
    }
}
