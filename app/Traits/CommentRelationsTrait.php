<?php

namespace App\Traits;
use App\Models\Comment;

trait CommentRelationsTrait {

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
}