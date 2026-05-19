<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $primaryKey = 'leave_id';
    
    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'days_taken',
        'status',
        'reason',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // FILTER SCOPE - Add this method
    public function scopeFilter($query, $filters)
    {
        return $query->when($filters['search'] ?? null, function ($q, $search) {
                $q->whereHas('employee', function ($sub) use ($search) {
                    $sub->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($filters['status'] ?? null, function ($q, $status) {
                $q->where('status', $status);
            })
            ->when($filters['leave_type'] ?? null, function ($q, $type) {
                $q->where('leave_type', $type);
            })
            ->when($filters['date_from'] ?? null, function ($q, $date) {
                $q->whereDate('start_date', '>=', $date);
            })
            ->when($filters['date_to'] ?? null, function ($q, $date) {
                $q->whereDate('end_date', '<=', $date);
            });
    }
}