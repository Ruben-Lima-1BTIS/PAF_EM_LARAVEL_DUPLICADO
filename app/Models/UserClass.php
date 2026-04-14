<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserClass extends Model
{
    protected $fillable = [
        'user_id',
        'class_id',
    ];

    protected $table = 'user_classes';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'user_classes');
    }


}
