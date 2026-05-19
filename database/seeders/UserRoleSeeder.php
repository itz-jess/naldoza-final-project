<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN ACCOUNT
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@company.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // HR MANAGER ACCOUNT
        DB::table('users')->insert([
            'name' => 'HR Manager',
            'email' => 'hr@company.com',
            'password' => Hash::make('hrmanager'),
            'role' => 'hr_manager',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // EMPLOYEE ACCOUNT
        DB::table('users')->insert([
            'name' => 'Jessica Naldoza',
            'email' => 'j.naldoza@company.com',
            'password' => Hash::make('employee123'),
            'role' => 'employee',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}