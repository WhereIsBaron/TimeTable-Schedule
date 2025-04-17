<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterTimetable extends Model
{
    protected $fillable = [
        'title',
        'description',
        'faculty_admin_id',
    ];

    public function faculty()
    {
        return $this->belongsTo(User::class, 'faculty_admin_id');
    }

    public function classCodes()
    {
        return $this->hasMany(FacultyClassCode::class, 'faculty_admin_id', 'faculty_admin_id');
    }
}
