<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            'status'=> $this->status,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at->format('d/m/Y'), 
            'updated_at' => $this->updated_at->format('d/m/Y') 
        ];
    }
}
