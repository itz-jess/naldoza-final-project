<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $primaryKey = 'performance_id';
    
    protected $fillable = [
        'employee_id',
        'review_date',
        'rating',
        'comments',
        'strengths',
        'areas_for_improvement',
        'reviewed_by',
    ];

    protected $casts = [
        'review_date' => 'date',
        'rating' => 'integer',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}