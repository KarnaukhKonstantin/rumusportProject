<?php

namespace App\Traits;
use App\Models\About;

trait AboutRelationsTrait {
   
    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill')->withPivot('about_id','skill_id');
    }

}