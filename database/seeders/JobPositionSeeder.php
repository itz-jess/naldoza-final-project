<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            // IT Department - Updated Philippines salaries
            ['title' => 'IT Support', 'department' => 'IT', 'base_pay' => 22000, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'System Administrator', 'department' => 'IT', 'base_pay' => 35000, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Software Developer', 'department' => 'IT', 'base_pay' => 32000, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'QA Tester', 'department' => 'IT', 'base_pay' => 25000, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Network Technician', 'department' => 'IT', 'base_pay' => 28000, 'created_at' => now(), 'updated_at' => now()],
            
            // HR Department
            ['title' => 'HR Assistant', 'department' => 'HR', 'base_pay' => 18000, 'created_at' => now(), 'updated_at' => now()],
            
            // Admin Department
            ['title' => 'Office Staff', 'department' => 'Admin', 'base_pay' => 15000, 'created_at' => now(), 'updated_at' => now()],
            
            // Maintenance Department
            ['title' => 'Janitor', 'department' => 'Maintenance', 'base_pay' => 12000, 'created_at' => now(), 'updated_at' => now()],
            
            // Security Department
            ['title' => 'Security Guard', 'department' => 'Security', 'base_pay' => 13000, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('job_positions')->insert($positions);
    }
}