<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();
        DB::table('roles')->truncate();

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Developer']);
        Role::create(['name' => 'Manager']);
        $superAdmin = Role::create(['name' => 'Super-Admin']);

        // DB::table('users')->insert([
        //     [
        //         'title' => 'Mr.',
        //         'first_name' => 'Fahath',
        //         'username' => 'fahath',
        //         'email' => 'fahath@example.com',
        //         'designation' => 'Software Developer',
        //         'email_verified_at' => now(),
        //         'password' => $this->customEncrypt('Fahath@123'),
        //         'contact' => '1234567890',
        //         'branch' => 'New York',
        //         'img' => 'john_doe_profile.jpg',
        //         'is_active' => 1,
        //         'remember_token' => Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //         'role_id' => 1,
        //     ],
        //     [
        //         'title' => 'Ms.',
        //         'first_name' => 'Jane Doe',
        //         'username' => 'jane',
        //         'designation' => 'Software Developer',
        //         'email' => 'janedoe@example.com',
        //         'email_verified_at' => now(),
        //         'password' => $this->customEncrypt('password123'),
        //         'contact' => '0987654321',
        //         'branch' => 'Los Angeles',
        //         'img' => 'jane_doe_profile.jpg',
        //         'is_active' => 1,
        //         'remember_token' => Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //         'role_id' => 2,
        //     ],
        // ]);

        $user = User::create([
            'title' => 'Mr.',
            'first_name' => 'Fahath',
            'username' => 'fahath',
            'email' => 'fahath@example.com',
            'designation' => 'Software Developer',
            'email_verified_at' => now(),
            'password' => 'Fahath@123',
            'contact' => '1234567890',
            'branch' => 'New York',
            'img' => 'john_doe_profile.jpg',
            'is_active' => 1,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'role_id' => 1,
        ]);

        $user->assignRole($superAdmin->name);
        // \App\Models\User::factory(10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function customEncrypt($pass)
    {
        $str = $pass;
        $key = '4QcTlzuaNUcX289Z9D0ovPCzb';
        $iv = "1234567812345678";
        $encryption_key = base64_encode($key);
        $encrypted = openssl_encrypt($str, 'aes-256-cbc', $encryption_key, true, $iv);
        $encrypted_data = base64_encode($encrypted);
        return ($encrypted_data);
    }
}
