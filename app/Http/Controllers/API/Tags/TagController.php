<?php

namespace App\Http\Controllers\API\Tags;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
	public function getAllTags()
	{
		$name = request()->name;

        if($name){
            $tags = Tag::where('name', 'like', '%' . $name . '%')->paginate(10);
        }else{
            if (request()->paginate == 1) {
                $tags = Tag::paginate(10);
            }else{
                 $tags = Tag::all();
            }
            
        }

        return response()->json($tags);
	}




    public function storeTag(Request $request)
    {
        $newTag = request()->validate([
            'name' => 'required',
        ]);
        $tag = Tag::create($newTag);

        return response()->json($tag);
    }




    public function updateTag(Request $request, $id)
    {
        $newTag = request()->validate([
            'name' => 'required',
            
        ]);
        Tag::where('id', $id)->update($newTag);

        return response()->json(Tag::find($id));
    }




    public function deleteTag($id)
    {
        $tag = Tag::find($id);

        Tag::destroy($id);

        $tags = Tag::all();
        return response()->json($tags);
    }
}