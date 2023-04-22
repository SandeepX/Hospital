<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'username' => 'admin12',
            'password' => bcrypt('admin123'),
            'address' => 'kathmandu',
            'gender' => 'male', // male, female ,others
            'phone' => '9812111111',
            'is_active' => 1,
            'designation' => null,
            'role' => 'admin', // admin, user
            'description' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
