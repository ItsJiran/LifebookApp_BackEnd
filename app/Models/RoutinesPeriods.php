<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutinesPeriods extends Model
{
    use HasFactory;
    protected $fillable = [
        'routines_id',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',   
    ];
    public $timestamps = false;
}
