<?php

namespace App\Entities;

use App\Entities\TestData;
use App\Entities\InputData;
use App\Entities\Program;
use App\Entities\ProgramType;
use Illuminate\Database\Eloquent\Model;

class TestProgramTypes extends Model
{
    protected $table = 'tests_program_types';

    protected $fillable = [
        'test_types_id',
        'program_types_id',
    ];

    /**
     * Get all of the program types for the test.
     */
    public function programTypes()
    {
        return $this->hasMany(ProgramType::class, 'id', 'program_types_id');
    }

}
