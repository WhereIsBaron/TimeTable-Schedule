<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_code',
        'instructor_name',
        'room',
        'day_of_week',
        'start_time',
        'end_time',
    ];
}

