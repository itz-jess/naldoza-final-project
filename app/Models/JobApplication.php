<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    'job_position_id',
    'applicant_name',
    'email',
    'age',
    'sex',
    'contact_number',
    'address',
    'skills',
    'experience',
    'resume_file',
    'profile_picture',
    'status',
    'rejected_at',
    'created_employee_id',
    'converted_to_employee_at',
    ];

    protected $casts = [
        'rejected_at' => 'datetime',
        'converted_to_employee_at' => 'datetime',
    ];

    public function jobPosition()
    {
        return $this->belongsTo(JobPosition::class);
    }

    public function createdEmployee()
    {
        return $this->belongsTo(Employee::class, 'created_employee_id');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeHired($query)
    {
        return $query->where('status', 'hired');
    }   

    public function isConvertedToEmployee()
    {
            return !is_null($this->created_employee_id);
    }
}