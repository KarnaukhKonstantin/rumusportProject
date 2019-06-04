<?php

namespace App\Http\Controllers\API\About;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    public function getAuthorInfo()
    {
    	$info = About::paginate(10);

    	return response()->json($info);
    }
}
