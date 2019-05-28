<?php

namespace App\Http\Controllers\API\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAuthUser()
    {
    	$user =  Auth::user();

    	return $user;
    }
}
