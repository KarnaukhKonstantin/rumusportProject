<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TagRelationsTrait;
use App\Models\Node;

class Tag extends Model
{
	use TagRelationsTrait;
	
    protected $fillable = ['name', 'category_id'];

    protected $with = ['category'];

    protected $appends = ['node'];

    public function getNodeAttribute() 
    {
    	$node = Node::where('name', $this->name)->first();

    	return $node;
    }
}
