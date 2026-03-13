<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
    ];

    public function supervisors()
    {
        return $this->hasMany(User::class, 'company_id')
                    ->where('role', 'supervisor');
    }

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }
}
