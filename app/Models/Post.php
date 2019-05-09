<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PostRelationsTrait;

class Post extends Model
{
	use PostRelationsTrait;
	
    protected $fillable = ['title', 'description', 'image', 'category_id', 'author_id', 'count_watches', 'short_description'];

    protected $with = ['tags', 'category', 'links'];


    public static function boot()
    {
        parent::boot();

        static::deleted(function ($instance) {
            $links = $instance->links()->get();
            foreach ($links as $link) {
              $link->delete();
            }
            return true;
        });
    }
}
