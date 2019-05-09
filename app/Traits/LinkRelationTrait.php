<?php

namespace App\Traits;
use App\Models\Link;

trait LinkRelationsTrait {

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

}