<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'company_id',
        'title',
        'start_date',
        'end_date',
        'total_hours_required',
        'min_hours_day',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function studentAssignment()
    {
        return $this->hasOne(UserInternship::class);
    }

    public function supervisorAssignment()
    {
        return $this->hasOne(UserInternship::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'user_internships', 'internship_id', 'user_id')
            ->wherePivot('role', 'student');
    }

    public function supervisors()
    {
        return $this->belongsToMany(User::class, 'user_internships', 'internship_id', 'user_id')
            ->wherePivot('role', 'supervisor');
    }

    public function hours()
    {
        return $this->hasMany(Hour::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
