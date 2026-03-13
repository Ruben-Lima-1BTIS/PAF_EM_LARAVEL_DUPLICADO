<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInternship extends Model
{
    protected $fillable = [
        'user_id',
        'internship_id',
    ];

    protected $table = 'user_internships';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function internship()
    {
        return $this->belongsTo(Internship::class, 'internship_id');
    }
}
