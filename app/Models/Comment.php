<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CommentRelationsTrait;

class Comment extends Model
{
    use CommentRelationsTrait;

    protected $fillable = ['post_id', 'body', 'user_id'];
}
