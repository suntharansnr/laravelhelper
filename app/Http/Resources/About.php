<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class About extends JsonResource
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
           'title'=>$this->title,
           'slug' => $this->slug,
           'content' => $this->content,
           'status' => $this->status,
           'img_path'=> $this->img_path,
           'created_at' => $this->created_at->format('d/m/Y'), 
           'updated_at' => $this->updated_at->format('d/m/Y') 
        ];
    }
}
