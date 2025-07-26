<?php

namespace App\Entities;

use App\Entities\AvailableData;
use App\Entities\Table;
use App\Entities\Protocol;
use Illuminate\Database\Eloquent\Model;

class TestProtocol extends Model
{
    protected $table = 'test_protocols';

    protected $fillable = [
        'test_type_id',
        'protocol_id',
    ];

    /**
     * The data that belong to the protocol id.
     */
    public function protocols()
    {
        return $this->belongsTo(Protocol::class, 'protocol_id', 'id');
    }

}
