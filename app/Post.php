<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Post extends Model implements Viewable
{
      use Notifiable;
      use InteractsWithViews;

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $dates = [
                 'created_at',
                 'updated_at',
                 // your other new column
      ];
      protected $primaryKey = 'id';
      protected $fillable = [
           'title',
           'slug',
           'content',
           'status',
           'post_type',
           'img_path',
           'video_path',
           'url',
           'user_id',
           'category_id',
           'views'
      ];

      public function user()
      {
        return $this->belongsTo('App\User');
      }

      public function category()
      {
        return $this->belongsTo('App\Category');
      }

      public function comments()
      {
          return $this->hasMany(Comment::class)->whereNull('parent_id');
      }

      public function tags()
      {
        return $this->belongsToMany('App\Tag');
      }
}
