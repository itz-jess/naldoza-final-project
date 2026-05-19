<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'department',
        'base_pay',
        'description',
        'requirements',
        'is_active',
    ];

    protected $casts = [
        'base_pay' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}