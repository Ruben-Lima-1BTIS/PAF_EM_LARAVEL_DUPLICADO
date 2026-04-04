<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'student_id',
        'internship_id',
        'file_path',
        'original_name',
        'status',
        'supervisor_reviewed_by',
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
