<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metatag extends Model
{
    protected $fillable = ['title','route','page_name','description','keywords','author','canonical','og:url','og:image','og:description','og:title','og:site:name','og:see_also','name','googledescription','description','image','twitter:card','twitter:url','twitter:title','twitter:description','twitter:image'];
}
