<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProgramData extends Model
{
    protected $table = 'program_data';

    protected $fillable = [
        'program_id',
        'table_id',
        'column_name',
        'key',
        'value',
        'row_id'
    ];

}
