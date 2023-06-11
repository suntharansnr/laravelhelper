<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Country extends JsonResource
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
            'sort_name' => $this->sort_name,
            'name' => $this->name,
            'status' => $this->status,
            'user_name' => $this->user ? $this->user->name :'',
            'continent_name' => $this->continent ? $this->continent->name : '',
            'created_at' => $this->created_at ? $this->created_at->format('d/m/Y') :'', 
            'updated_at' => $this->updated_at ?  $this->updated_at->format('d/m/Y') :'' 
        ];
    }
}
