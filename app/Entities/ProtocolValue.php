<?php

namespace App\Entities;

use App\Entities\AvailableData;
use App\Entities\Table;
use Illuminate\Database\Eloquent\Model;

class ProtocolValue extends Model
{
    protected $table = 'protocol_values';

    protected $fillable = [
        'protocol_id',
        'value',
        'column_name',
    ];

}
