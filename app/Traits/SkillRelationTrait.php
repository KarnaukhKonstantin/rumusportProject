<?php

namespace App\Traits;
use App\Models\Skill;

trait ProjectRelationsTrait {

    public function projects()
    {
        return $this->hasMany('App\Models\Project')->withPivot('project_id','skill_id');
    }
}