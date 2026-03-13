<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable = [
        'student_id',
        'internship_id',
        'supervisor_reviewed_by',
        'hours',
        'date',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')
                    ->where('role', 'student');
    }

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'supervisor_reviewed_by')
                    ->where('role', 'supervisor');
    }
}
