<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\TableColumn;
use App\Http\Resources\TableColumnCollection;
use App\Http\Resources\ColumnCollection;

class Table extends JsonResource
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
            'title' => $this->name,
            'columns' => new TableColumnCollection($this->collumns),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
