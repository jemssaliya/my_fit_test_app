<?php

namespace App\Entities;

use App\Entities\Table;
use Illuminate\Database\Eloquent\Model;

class TableColumn extends Model
{
    protected $table = 'table_columns';

    protected $fillable = [
        'table_id',
        'column_id',
        'is_protected',
        'color_code',
        'display',
        'sq', // sequence
        // 'tablecolumable_id',
        // 'tablecolumable_type',
    ];

}
