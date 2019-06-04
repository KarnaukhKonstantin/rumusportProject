<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['name', 'description', 'work_info', 'exp_info', 'personal_info', 'hobbies_info', 'image'];
}
