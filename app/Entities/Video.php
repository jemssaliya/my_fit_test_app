<?php

namespace App\Entities;

use App\Entities\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'title',
        'url',
        'status',
    ];

}
