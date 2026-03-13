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
        return $this->hasManyThrough(
            User::class,
            UserInternship::class,
            'internship_id',
            'id',
            'id',
            'student_id'
        )->students();
    }

    public function supervisors()
    {
        return $this->hasManyThrough(
            User::class,
            UserInternship::class,
            'internship_id',
            'id',
            'id',
            'supervisor_id'
        )->supervisors();
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
