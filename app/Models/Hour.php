<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'student_id',
        'internship_id',
        'status',
        'supervisor_reviewed_by',
        'supervisor_comment',
        'reviewed_at',
        'duration_hours',
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

    public function scopeForStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function getDurationHoursAttribute()
    {
        return Carbon::parse($this->start_time)
            ->diffInMinutes(Carbon::parse($this->end_time)) / 60;
    }
}
