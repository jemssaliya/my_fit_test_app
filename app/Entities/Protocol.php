<?php

namespace App\Entities;

use App\Entities\AvailableData;
use App\Entities\Table;
use App\Entities\ProtocolValue;
use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    protected $table = 'protocols';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the values for the protocol.
     */
    public function values()
    {
        return $this->hasMany(ProtocolValue::class);
    }

}
