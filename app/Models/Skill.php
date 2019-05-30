<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SkillRelationTraits;

class Skill extends Model
{
	use SkillRelationTraits;
	
    protected $fillable = ['name'];
}
