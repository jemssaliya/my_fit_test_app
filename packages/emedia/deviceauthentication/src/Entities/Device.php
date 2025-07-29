<?php

namespace EMedia\DeviceAuthentication\Entities;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';
    protected $fillable = [
        'user_id',
        'device_id',
        'device_type',
        'device_push_token',
        'client_id',
    ];
}
