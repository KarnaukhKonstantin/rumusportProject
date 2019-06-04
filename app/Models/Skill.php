<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SkillRelationsTrait;

class Skill extends Model
{
	use SkillRelationsTrait;
	
    protected $fillable = ['name', 'description', 'image'];
}
