<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','status','parent_id'];

    protected $dates = ['deleted_at'];

    public function childs() {
        return $this->hasMany('App\Category','parent_id','id') ;
    }
}
