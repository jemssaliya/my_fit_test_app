<?php

namespace App\Entities;

use App\Entities\Column;
use Illuminate\Database\Eloquent\Model;

class FormElement extends Model
{
    protected $table = 'form_elements';

    protected $fillable = [
        'name',
        'field_id',
        'data_type',
        'formable_id',
        'formable_type',
    ];

    /**
     * Get all of the owning consumable models.
     */
    public function formable()
    {
        return $this->morphTo();
    }

}
