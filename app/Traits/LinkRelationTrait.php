<?php

namespace App\Traits;
use App\Models\Link;
use App\Models\Project;

trait LinkRelationsTrait {

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }

}