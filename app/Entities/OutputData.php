<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class OutputData extends Model
{
    protected $table = 'output_data';

    protected $fillable = [
        'program_id',
        'label',
        'name',
        'fieldId',
        'value',
    ];

}