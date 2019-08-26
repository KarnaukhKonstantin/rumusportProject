<?php

namespace App\Traits;
use App\Models\Skill;

trait SkillRelationsTrait {

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project')->withPivot('project_id','skill_id');
    }

    public function about()
    {
        return $this->belongsToMany('App\Models\About')->withPivot('about_id','skill_id');
    }
}