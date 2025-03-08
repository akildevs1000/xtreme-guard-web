<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MenusTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\SettingsTableSeeder;
use Database\Seeders\EmployeesTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // EmployeesTableSeeder::class,
            UsersTableSeeder::class,
            MenusTableSeeder::class,
            SettingsTableSeeder::class,
        ]);
    }
}
