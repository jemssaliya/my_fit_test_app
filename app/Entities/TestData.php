<?php

namespace App\Entities;

use App\Entities\Column;

// use App\Entities\Country;
use Illuminate\Database\Eloquent\Model;

class TestData extends Model
{
    protected $table = 'test_data';

    protected $fillable = [
        'test_id',
        'table_id',
        'column_name',
        'key',
        'value',
        'row_id'
    ];

    /**
     * The columns that belong to the table.
     */
    public function collumns()
    {
        return $this->belongsToMany(Column::class,
            'table_columns',
            'table_id',
            'column_id'
        )
            ->withPivot('is_protected', 'color_code', 'display')
            ->orderBy('table_id', 'ASC');
    }

}
