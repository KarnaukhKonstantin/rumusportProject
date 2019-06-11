<?php

namespace App\Traits;
use App\Models\Project;

trait ProjectRelationsTrait {

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withPivot('project_id','tag_id');
    }

    public function links()
    {
        return $this->hasMany('App\Models\Link', 'project_id');
    }

    public function attachments()
    {
        return $this->hasMany('App\Models\Attachment', 'project_id');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill')->withPivot('project_id','skill_id');
    }
}