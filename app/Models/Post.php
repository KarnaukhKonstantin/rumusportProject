<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PostRelationsTrait;

class Post extends Model
{
	use PostRelationsTrait;
	
    protected $fillable = ['title', 'description', 'image', 'category_id', 'author_id', 'count_watches', 'short_description'];
}
