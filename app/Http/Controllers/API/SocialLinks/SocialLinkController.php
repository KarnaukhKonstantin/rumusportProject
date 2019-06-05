<?php

namespace App\Http\Controllers\API\SocialLinks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialLink;

class SocialLinkController extends Controller
{
    public function getAllSocLinks()
    {
    	$social_links = SocialLink::paginate(10);

    	return response()->json($social_links);
    }





    public function getSocLinks()
    {
        $social_links = SocialLink::all();

        return response()->json($social_links);  
    }






    public function getSocLink($id)
    {
    	$social_link = SocialLink::where('id', $id)->first();

        return response()->json($social_link);	
    }





    public function storeSocLink(Request $request)
    {
    	$newSoc = request()->validate([
            'name' => 'required',
            'link' => 'required'
        ]);
        $link = SocialLink::create($newSoc);

        return response()->json($link);	
    }





    public function updateSocLink(Request $request, $id)
    {
    	$newSoc = request()->validate([
            'name' => 'required',
            'link' => 'required'
        ]);
        SocialLink::where('id', $id)->update($newSoc);

        return response()->json(SocialLink::find($id));
    }





    public function deleteSocLink($id)
    {
    	$link = SocialLink::find($id);

        SocialLink::destroy($id);

        $links = SocialLink::all();

        return response()->json($links);	
    }
}
