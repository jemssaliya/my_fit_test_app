<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AvailableData extends Model
{
    protected $table = 'available_data';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get all of the tables.
     */
    public function table()
    {
        return $this->morphMany('App\Entities\Table', 'tabalable');
    }

}
