<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role Check Methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isHrManager()
    {
        return $this->role === 'hr_manager';
    }

    public function isEmployee()
    {
        return $this->role === 'employee';
    }

    // Relationships
    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

    public function approvedLeaves()
    {
        return $this->hasMany(Leave::class, 'approved_by');
    }

    public function reviewedPerformances()
    {
        return $this->hasMany(Performance::class, 'reviewed_by');
    }

    public function uploadedAttachments()
    {
        return $this->hasMany(Attachment::class, 'uploaded_by');
    }
}