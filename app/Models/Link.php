<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LinkRelationsTrait;

class Link extends Model
{
	use LinkRelationsTrait;
	
    protected $fillable = ['body', 'post_id'];
}
