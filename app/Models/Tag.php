<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TagRelationsTrait;

class Tag extends Model
{
	use TagRelationsTrait;
	
    protected $fillable = ['name'];
}
