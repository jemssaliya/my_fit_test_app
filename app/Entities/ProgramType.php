<?php

namespace App\Entities;

use App\Entities\Table;
use Illuminate\Database\Eloquent\Model;

class ProgramType extends Model
{
    protected $table = 'program_types';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the table associated with the test_types.
     */
    public function table()
    {
        return $this->belongsToMany(Table::class, 'test_type_tables', 'test_type_id', 'table_id');
    }

    /**
     * Get all of the tables.
     */
    public function tables()
    {
        return $this->morphMany(Table::class, 'tabalable');
    }

}
