<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AboutRelationsTrait;

class About extends Model
{
	use AboutRelationsTrait;
	
    protected $fillable = ['name', 'description', 'work_info', 'exp_info', 'personal_info', 'hobbies_info', 'image'];

    protected $with = ['skills'];
}
