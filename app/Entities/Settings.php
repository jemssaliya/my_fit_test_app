<?php

namespace App\Entities;

use App\Entities\Column;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'vaue',
        'data_type',
        'description'
    ];

}