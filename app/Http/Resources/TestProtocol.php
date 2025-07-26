<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestProtocol extends JsonResource
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
            'test_type_id' => $this->test_type_id,
            'protocol_id' => $this->protocol_id,
            'protocols' => $this->protocols,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}