<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
  protected $fillable = [
      'name','value','status'
  ];
}
