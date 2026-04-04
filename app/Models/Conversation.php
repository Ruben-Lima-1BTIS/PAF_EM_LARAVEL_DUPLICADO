<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')
            ->where('role', 'student');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id')
            ->where('role', 'supervisor');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
