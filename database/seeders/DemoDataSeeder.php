<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 additional employees (Philippines salary rates)
        $employees = [
            ['Maria', 'Santos', 'maria.santos@company.com', 'HR Assistant', 'HR', 18000, '2023-02-10'],
            ['John', 'Cruz', 'john.cruz@company.com', 'Accounting Staff', 'Finance', 20000, '2023-03-15'],
            ['Anna', 'Reyes', 'anna.reyes@company.com', 'Marketing Assistant', 'Marketing', 17000, '2023-04-20'],
            ['Mark', 'Villanueva', 'mark.villanueva@company.com', 'Sales Associate', 'Sales', 16000, '2023-05-01'],
            ['Christine', 'Garcia', 'christine.garcia@company.com', 'IT Support', 'IT', 22000, '2023-06-12'],
            ['Patrick', 'Fernandez', 'patrick.fernandez@company.com', 'QA Tester', 'IT', 25000, '2023-07-18'],
            ['Sofia', 'Mendoza', 'sofia.mendoza@company.com', 'Network Administrator', 'IT', 30000, '2023-08-22'],
            ['Ramon', 'Aguilar', 'ramon.aguilar@company.com', 'Admin Staff', 'Admin', 15000, '2023-09-05'],
            ['Tess', 'Lorenzo', 'tess.lorenzo@company.com', 'Security Guard', 'Security', 13000, '2023-10-10'],
            ['Ben', 'Ramos', 'ben.ramos@company.com', 'Janitor', 'Maintenance', 12000, '2023-11-15'],
        ];

        foreach ($employees as $emp) {
            // Create user account for each employee
            $user = User::create([
                'name' => $emp[0] . ' ' . $emp[1],
                'email' => $emp[2],
                'password' => Hash::make('password123'),
                'role' => 'employee',
            ]);

            // Create employee record
            Employee::create([
                'user_id' => $user->id,
                'first_name' => $emp[0],
                'last_name' => $emp[1],
                'email' => $emp[2],
                'position' => $emp[3],
                'department' => $emp[4],
                'salary' => $emp[5],
                'hire_date' => $emp[6],
                'leave_credits' => 15,
                'is_active' => true,
                'approved_at' => now(),
            ]);
        }

        // Add attendance records for the last 30 days for ALL employees
        $allEmployees = Employee::all();
        $startDate = now()->subDays(30);
        
        for ($i = 0; $i < 30; $i++) {
            $date = $startDate->copy()->addDays($i);
            
            // Skip weekends (Saturday and Sunday)
            if ($date->isWeekend()) {
                continue;
            }
            
            foreach ($allEmployees as $employee) {
                // Random time between 8:00 AM and 9:00 AM
                $minute = rand(00, 45);
                $timeIn = '08:' . str_pad($minute, 2, '0', STR_PAD_LEFT) . ':00';
                
                // Determine if late (after 8:30 AM)
                $status = $timeIn > '08:30:00' ? 'late' : 'present';
                
                // Random time out between 5:00 PM and 6:00 PM
                $minuteOut = rand(00, 30);
                $timeOut = '17:' . str_pad($minuteOut, 2, '0', STR_PAD_LEFT) . ':00';
                
                Attendance::create([
                    'employee_id' => $employee->id,
                    'date' => $date,
                    'time_in' => $timeIn,
                    'time_out' => $timeOut,
                    'status' => $status,
                ]);
            }
        }
    }
}