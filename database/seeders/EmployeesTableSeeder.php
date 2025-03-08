<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('employees')->insert([
                'last_name' => $faker->lastName,
                'employee_id' => 'EMP' . $faker->unique()->numberBetween(1000, 9999),
                'designation' => $faker->jobTitle,
                'phone_number' => $faker->phoneNumber,
                'email' => 'employee' . $i . '@example.com',
                'branch' => $faker->company,
                'department' => 'IT',
                'joining_date' => $faker->date,
                'country' => $faker->country,
                'img' => null,
                'cover_img' => 'cover_img_path_' . $i,
                'first_name' => $faker->firstName,
                'description' => $faker->sentence,
            ]);
        }
    }
}
