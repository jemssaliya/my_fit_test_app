<?php

namespace App\Entities;

use App\Entities\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'file_path',
        'file_url',
        'status',
    ];

}
