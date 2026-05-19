<?php

namespace App\Services;

use App\Models\User;
use App\Models\Employee;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class HiringService
{
    public function convertToEmployee(JobApplication $application, array $additionalData = []): Employee
    {
        return DB::transaction(function () use ($application, $additionalData) {
            // Check if already converted
            if ($application->isConvertedToEmployee()) {
                throw new \Exception('Applicant has already been converted to an employee.');
            }

            // Extract data from application
            $nameParts = explode(' ', $application->applicant_name, 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? '';

            // Create User Account
            $user = User::create([
                'name' => $application->applicant_name,
                'email' => $application->email,
                'password' => Hash::make('password123'), // Send email to reset
                'role' => 'employee',
            ]);

            // Create Employee Record
            $employee = Employee::create([
                'user_id' => $user->id,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $application->email,
                'position' => $application->jobPosition->title ?? 'Staff',
                'department' => $application->jobPosition->department ?? 'General',
                'salary' => $additionalData['salary'] ?? $application->jobPosition->base_pay ?? 25000,
                'hire_date' => $additionalData['hire_date'] ?? now(),
                'contact_number' => $application->contact_number,
                'address' => $application->address,
                'skills' => $application->skills,
                'leave_credits' => 15,
                'is_active' => true,
                'approved_at' => now(),
                'approved_by' => auth()->id(),
            ]);

            // Link application to employee
            $application->update([
                'status' => 'hired',
                'created_employee_id' => $employee->id,
                'converted_to_employee_at' => now(),
            ]);

            return $employee;
        });
    }
}