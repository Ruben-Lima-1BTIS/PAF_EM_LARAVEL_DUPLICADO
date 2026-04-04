<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    public $timestamps = false;

    protected $fillable = [
        'course',
        'sigla',
        'year',
        'coordinator_id',
    ];

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id')
            ->where('role', 'coordinator');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'class_id')
            ->where('role', 'student');
    }
}
