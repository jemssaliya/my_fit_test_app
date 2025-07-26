<?php

namespace App\Entities;


use App\Shared\FormatsDate;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use FormatsDate;

    protected $table = 'tests';

    protected $fillable = [
        'name',
        'hr_peak',
        'bp',
        'hr_rest',
        'age',
        'weight',
        'test_type',
        'client_id',
        'user_id',
        'slope',
        'intercept',
    ];

    /**
     * Client tests count
     *
     */
    public function getNameAttribute()
    {
        return $this->attributes['name'] ? $this->attributes['name'] : 'Unnamed';
    }

    /**
     * Get all of the test data for the test.
     */
    public function testData()
    {
        return $this->hasMany(TestData::class, 'test_id', 'id')
            ->orderBy('id', 'ASC')
            ->orderBy('test_id', 'ASC')
            ->orderBy('table_id', 'ASC')
            ->orderBy('row_id', 'ASC');
    }

    /**
     * Get all of the input data for the test.
     */
    public function inputData()
    {
        return $this->hasMany(InputData::class)->orderBy('test_id', 'ASC');
    }

    /**
     * Get all of the programs for the test.
     */
    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    /**
     * Get all of the programs for the test.
     */
    public function testPrograms()
    {
        return $this->hasMany(TestPrograms::class);
    }

    /**
     * Get test type.
     */
    public function testType()
    {
        return $this->belongsTo(TestType::class, 'test_type', 'id');
    }

}
