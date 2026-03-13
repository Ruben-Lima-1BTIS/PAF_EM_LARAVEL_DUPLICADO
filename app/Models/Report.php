<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_reviewed_by');
    }
}
