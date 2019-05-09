<?php

namespace App\Traits;
use App\Models\Tag;

trait TagRelationsTrait {
    
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }
}