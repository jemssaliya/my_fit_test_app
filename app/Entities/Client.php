<?php

namespace App\Entities;

use App\Entities\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'dob',
        'gender',
        'user_id',
    ];

    protected $appends = ['age', 'tests'];

//    protected $dates = ['dob'];
//
//    protected $dateFormat = 'Y-m-d';

    /**
     * Client age
     *
     */
    public function getAgeAttribute()
    {
        $now = Carbon::now();
        return Carbon::parse(isset($this->attributes['dob']) ? $this->attributes['dob'] : $now)->age;
    }

    /**
     * Client dob
     *
     */
    public function getDobAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->toDateString();
    }

    /**
     * Client tests count
     *
     */
    public function getTestsAttribute()
    {
        return $this->tests()->count();
    }

    /**
     * A client may have one or more tests
     *
     * @return hasMany
     */
    public function tests()
    {
        return $this->hasMany(test::class, 'client_id');
    }

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setDobAttribute($value)
    {

        $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value);
    }

}
