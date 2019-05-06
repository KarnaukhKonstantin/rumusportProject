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
        return $this->belongsTo('App\Models\Categories\Category', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tags\Tag')->withPivot('post_id','tag_id');
    }

}