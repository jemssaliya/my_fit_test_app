<?php

namespace App\Entities;

// use App\Entities\Country;
use Illuminate\Database\Eloquent\Model;

class TestParam extends Model
{
    protected $table = 'test_params';

    protected $fillable = [
        'label',
        'name',
    ];

}
