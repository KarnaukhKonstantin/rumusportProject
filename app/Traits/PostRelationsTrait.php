<?php

namespace App\Traits;
use App\Models\Post;

trait PostRelationsTrait {

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withPivot('post_id','tag_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id');
    }

    public function links()
    {
        return $this->hasMany('App\Models\Link', 'post_id');
    }

}