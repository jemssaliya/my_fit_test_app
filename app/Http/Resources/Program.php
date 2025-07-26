<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Program extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'test_id' => $this->test_id,
            'test_type' => $this->test_type,
            'program_type' => $this->program_type,
            'program_type_data' => $this->programType,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}