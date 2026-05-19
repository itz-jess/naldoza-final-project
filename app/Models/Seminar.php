<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'venue',
        'certificate_file',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_seminar')
                    ->withPivot('attended_date')
                    ->withTimestamps();
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}