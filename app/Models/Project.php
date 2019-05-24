<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'main_description', 'category_id', 'secondary_description'];

    protected $with = ['tags', 'category', 'links', 'attachments', 'skills'];
}
