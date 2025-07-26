<?php

namespace App\Entities;

use App\Entities\Column;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';

    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the owning tabalable models.
     */
    public function tabalable()
    {
        return $this->morphTo();
    }

    /**
     * The columns that belong to the table.
     */
    public function collumns()
    {
        return $this->belongsToMany(
            Column::class,
            'table_columns',
            'table_id',
            'column_id'
        )
            ->withPivot('is_protected', 'color_code', 'display')
            ->orderBy('table_id', 'ASC')
            ->orderBy('sq', 'ASC');
    }

}
