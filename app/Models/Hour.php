<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'student_id',
        'internship_id',
    ];


    public $timestamps = false;

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
