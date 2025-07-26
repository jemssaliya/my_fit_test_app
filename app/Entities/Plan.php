<?php

namespace App\Entities;

use App\Entities\Column;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($get)
 */
class Plan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'stripe_plan',
        'cost',
        'description'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
