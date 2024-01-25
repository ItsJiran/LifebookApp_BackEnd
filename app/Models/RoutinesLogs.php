<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutinesLogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'routines_id',
        'val',
        'date',
    ];

    public $timestamps = false;
}
