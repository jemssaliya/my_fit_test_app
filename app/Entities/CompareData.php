<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CompareData extends Model
{
    protected $table = 'compare_data';

    protected $fillable = [
        'compare_id',
        'test_type',
        'x',
        'y',
        'color_code'
    ];

}
