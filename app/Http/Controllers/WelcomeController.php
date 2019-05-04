<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function showPlatform()
    {
        return view('platform');
    }



    public function showAdmin()
    {
        return view('admin');
    }
}
