<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routines extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'filter_color',
        'color',
        'icon_id',        
        'title',
        'description',
        'max_val',
    ];
}
