<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $primaryKey = 'attendance_id';
    
    protected $fillable = [
        'employee_id',
        'date',
        'time_in',
        'time_out',
        'status',
        'remarks',
    ];

    protected $casts = [
        'date' => 'date',
        'time_in' => 'datetime',
        'time_out' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    // Check if employee is late (after 8:30 AM)
    public function getIsLateAttribute()
    {
        if (!$this->time_in) return false;
        return $this->time_in > '08:30:00';
    }
}