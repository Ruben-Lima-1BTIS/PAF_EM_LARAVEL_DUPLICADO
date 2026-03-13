<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSupervisor extends Model
{
    protected $fillable = [
        'student_id',
        'supervisor_id',
    ];

    protected $table = 'student_supervisors';

    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
