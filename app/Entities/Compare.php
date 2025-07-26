<?php

namespace App\Entities;

use App\Entities\CompareData;
use App\Entities\Client;
use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    protected $table = 'compare';

    protected $fillable = [
        'client_id'
    ];

    /**
     * Get all of the compare data for the compare.
     */
    public function compareData()
    {
        return $this->hasMany(CompareData::class)
            ->orderBy('compare_id', 'ASC')
            ->orderBy('test_type', 'ASC');
    }

    /**
     * Get all of the compare data for the compare.
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

}
