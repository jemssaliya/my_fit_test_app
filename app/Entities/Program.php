<?php

namespace App\Entities;

use App\Entities\Column;
use App\Entities\FormElement;
use App\Entities\Table;
use App\Entities\ProgramData;
use App\Entities\ProgramType;
use App\Entities\OutputData;
use App\Shared\FormatsDate;
use App\Shared\HasLocalDates;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use FormatsDate;

    protected $table = 'programs';

    protected $fillable = [
        'name',
        'test_id',
        'test_type',
        'program_type',
    ];

    /**
     * Get all of the form elements for the program.
     */
    public function formElements()
    {
        return $this->morphMany(FormElement::class, 'formable');
    }

    /**
     * Get all of the tables for the program.
     */
    public function tables()
    {
        return $this->morphMany(Table::class, 'tabalable');
    }

    /**
     * Get all of the output data for the test.
     */
    public function outputData()
    {
        return $this->hasMany(OutputData::class)->orderBy('program_id', 'ASC');
    }

    /**
     * Get all of the output data for the test.
     */
    public function programType()
    {
        return $this->belongsTo(ProgramType::class, 'program_type', 'id');
    }

    /**
     * Get all of the program data for the program.
     */
    public function programData()
    {
        return $this->hasMany(ProgramData::class)
            ->orderBy('program_id', 'ASC')
            ->orderBy('id', 'ASC')
            ->orderBy('table_id', 'ASC')
            ->orderBy('row_id', 'ASC');
    }

    /**
     * Get test type.
     */
    public function testType()
    {
        return $this->belongsTo(TestType::class, 'test_type', 'id');
    }

    /**
     * Get test type.
     */
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id', 'id');
    }

}
