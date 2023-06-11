<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Radio extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "genre_id" => $this->genre_id,
            "type_id" => $this->type_id,
            "continent_id" => $this->continent_id,
            "country_id" => $this->country_id,
            "state_id" => $this->state_id,
            "city_id" => $this->city_id,
            "category_id" => $this->category_id,
            "language_id" => $this->language_id,
            "user_id" => $this->user_id,
            "description" => $this->description,
            "stream_url" => $this->stream_url,
            "logo" => $this->logo,
            "status" => $this->status,
            "featured" => $this->featured,
            "visit_count" => $this->visit_count,
            "address" => $this->address,
            "email" => $this->email,
            "twitter_url" => $this->twitter_url,
            "facebook_url" => $this->facebook_url,
            "linkedin_url" => $this->linkedin_url,
            "website" => $this->website,
            "telephone" => $this->telephone,
            "created_at" => $this->created_at->format('d/m/Y'),
            "updated_at" => $this->updated_at->format('d/m/Y')
        ];

    }
}
