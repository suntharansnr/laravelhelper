<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name','id','status','amenities_type'
    ];
    public function Properties()
    {
      return $this->belongsToMany('App\Property');
    }
}
