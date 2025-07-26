<?php

namespace App\Entities;

use App\Entities\AvailableData;
use App\Entities\Table;
use App\Entities\TestProtocol;
use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    protected $table = 'test_types';

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

    /**
     * The data that belong to the test types.
     */
    public function availableData()
    {
        return $this->belongsToMany('test_type_available_data');
    }

    /**
     * The data that belong to the test types.
     */
    public function protocols()
    {
        return $this->hasMany(TestProtocol::class);
    }

}
