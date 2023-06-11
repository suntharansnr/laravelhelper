<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Continent extends JsonResource
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
            'code' => $this->code,
            'contient_name' => $this->contient_name,
            'status' => $this->status,
            'user_name' => $this->user->name,
            'created_at' => $this->created_at ? $this->created_at->format('d/m/Y') : '', 
            'updated_at' => $this->updated_at ? $this->updated_at->format('d/m/Y') : ''
        ];
    }
}
