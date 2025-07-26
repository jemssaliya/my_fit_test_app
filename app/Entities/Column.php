<?php

namespace App\Entities;

use App\Entities\Table;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = 'columns';

    protected $fillable = [
        'name',
        'heading',
        'sub_heading',
        'description',
        'data_type',
    ];

}
