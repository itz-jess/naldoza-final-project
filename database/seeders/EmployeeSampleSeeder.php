<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSampleSeeder extends Seeder
{
    public function run(): void
    {
        // Get the user IDs using YOUR email addresses
        $hrUserId = DB::table('users')->where('email', 'hr@company.com')->first()->id;
        $employeeUserId = DB::table('users')->where('email', 'j.naldoza@company.com')->first()->id;

        // HR Manager Employee Record
        DB::table('employees')->insert([
            'user_id' => $hrUserId,
            'first_name' => 'HR',
            'last_name' => 'Manager',
            'email' => 'hr@company.com',
            'position' => 'HR Manager',
            'department' => 'HR',
            'salary' => 50000,
            'is_active' => true,
            'approved_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Employee Record for Jessica Naldoza
        DB::table('employees')->insert([
            'user_id' => $employeeUserId,
            'first_name' => 'Jessica',
            'last_name' => 'Naldoza',
            'email' => 'j.naldoza@company.com',
            'position' => 'Software Developer',
            'department' => 'IT',
            'salary' => 35000,
            'is_active' => true,
            'approved_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}