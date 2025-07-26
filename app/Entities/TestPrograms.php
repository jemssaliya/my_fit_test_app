<?php

namespace App\Entities;

use App\Entities\TestData;
use App\Entities\InputData;
use App\Entities\Program;
use Illuminate\Database\Eloquent\Model;

class TestPrograms extends Model
{
    protected $table = 'test_programs';

    protected $fillable = [
        'test_id',
        'program_id',
    ];

}
