<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ProjectRelationsTrait;

class Project extends Model
{
	use ProjectRelationsTrait;
	
    protected $fillable = ['name', 'main_description', 'category_id', 'secondary_description', 'embedded_experience', 'image'];

    protected $with = ['tags', 'category', 'links', 'attachments', 'skills'];
}
