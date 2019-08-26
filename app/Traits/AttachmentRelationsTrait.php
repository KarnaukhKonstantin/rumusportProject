<?php

namespace App\Traits;
use App\Models\Attachment;

trait AttachmentRelationsTrait {
   
    public function project()
    {
        return $this->belongsToMany('App\Models\Project')->withPivot('project_id','attachment_id');
    }

}