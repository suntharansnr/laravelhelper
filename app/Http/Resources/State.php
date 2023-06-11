<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class State extends JsonResource
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
            'status' => $this->status,
            'user_name' => $this->user ? $this->user->name :'',
            'country_name' => $this->country ? $this->country->name : '',
            'created_at' => $this->created_at ? $this->created_at->format('d/m/Y') :'', 
            'updated_at' => $this->updated_at ?  $this->updated_at->format('d/m/Y') :'' 
        ];
    }
}
