<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class InputData extends Model
{
    protected $table = 'input_data';

    protected $fillable = [
        'test_id',
        'labal',
        'name',
        'fieldId',
        'value',
    ];

}