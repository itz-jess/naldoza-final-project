<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';
    
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'address',
        'contact_number',
        'position',
        'skills',
        'department',
        'rank',
        'salary',
        'leave_credits',
        'hire_date',
        'is_active',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'salary' => 'decimal:2',
        'leave_credits' => 'integer',
        'is_active' => 'boolean',
        'approved_at' => 'datetime',
        'hire_date' => 'date',
    ];

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'employee_id');
    }

    public function performances()
    {
        return $this->hasMany(Performance::class, 'employee_id');
    }

    public function seminars()
    {
        return $this->belongsToMany(Seminar::class, 'employee_seminar')
                    ->withPivot('attended_date')
                    ->withTimestamps();
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'employee_training')
                    ->withPivot('completed_date', 'status')
                    ->withTimestamps();
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_active', false);
    }

    // FILTER SCOPE - Add this method
    public function scopeFilter($query, $filters)
    {
        return $query->when($filters['search'] ?? null, function ($q, $search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
            })
            ->when($filters['department'] ?? null, function ($q, $department) {
                $q->where('department', $department);
            })
            ->when($filters['status'] ?? null, function ($q, $status) {
                if ($status === 'active') {
                    $q->where('is_active', true);
                } elseif ($status === 'pending') {
                    $q->where('is_active', false);
                }
            });
    }

    // Helper Methods for HR Dashboard
    public function getTotalAttendanceThisMonth()
    {
        return $this->attendances()
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();
    }

    public function getTotalLeavesTakenThisYear()
    {
        return $this->leaves()
            ->where('status', 'approved')
            ->whereYear('start_date', now()->year)
            ->sum('days_taken');
    }

    public function getRemainingLeaveCredits()
    {
        $used = $this->getTotalLeavesTakenThisYear();
        return max(0, $this->leave_credits - $used);
    }
}