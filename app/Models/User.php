<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Hour;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'class_id',
        'company_id',
        'first_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
    }

    const ROLE_ADMIN = 'admin';
    const ROLE_COORDINATOR = 'coordinator';
    const ROLE_SUPERVISOR = 'supervisor';
    const ROLE_STUDENT = 'student';

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isCoordinator(): bool
    {
        return $this->role === self::ROLE_COORDINATOR;
    }

    public function isSupervisor(): bool
    {
        return $this->role === self::ROLE_SUPERVISOR;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function scopeStudents($query)
    {
        return $query->where('role', 'student');
    }

    public function scopeSupervisors($query)
    {
        return $query->where('role', 'supervisor');
    }

    public function scopeCoordinators($query)
    {
        return $query->where('role', 'coordinator');
    }

    public function internships()
    {
        return $this->belongsToMany(Internship::class, 'user_internships', 'user_id', 'internship_id');
    }

    // relacoes dos supervisores
    public function supervisedStudents()
    {
        return $this->belongsToMany(User::class, 'student_supervisors', 'supervisor_id', 'student_id')
            ->where('users.role', 'student');
    }

    public function hoursToReview()
    {
        return Hour::whereIn('student_id', $this->supervisedStudents()->pluck('id'))
            ->where('status', 'pending');
    }

    
    public function getClass()
    {
        return $this->belongsTo(UserClass::class, 'class_id'); 
    }
        public function userClass()
    {
        return $this->hasOne(UserClass::class, 'user_id');
    }

}
