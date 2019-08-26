<?php

namespace App\Traits;
use App\Models\Tag;
use App\Models\Project;

trait TagRelationsTrait {
    
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}