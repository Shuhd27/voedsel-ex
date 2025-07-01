<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'number_of_adults',
        'number_of_children',
        'number_of_babies',
        'total_number_of_people',
        'receives_food_package',
        'IsActive',
        'Note'
    ];

    protected $casts = [
        'receives_food_package' => 'boolean',
        'IsActive' => 'boolean',
    ];
}
