<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // import User model
use Illuminate\Support\Facades\Hash; // import Hash for password

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate([
            'email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'), // hash password
                'role' => 'admin', // role must match your RBAC
        ]);
    }
}