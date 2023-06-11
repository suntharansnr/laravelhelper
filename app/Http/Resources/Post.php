<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
          'title' => $this->title,
          'slug' => $this->slug,
          'content' => $this->content,
          'status' => $this->status,
          'post_type' => $this->post_type,
          'img_path' => $this->img_path,
          'video_path' => $this->video_path,
          'url' => $this->url,
          'user_id' => $this->user->name,
          'category_id' => $this->category->name,
          "created_at" => $this->created_at->format('d/m/Y'),
          "updated_at" => $this->updated_at->format('d/m/Y')  
        ];
    }
}
