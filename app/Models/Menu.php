<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'meal_name',
        'price',
        'description',
        'mc_id',
    ];
}
