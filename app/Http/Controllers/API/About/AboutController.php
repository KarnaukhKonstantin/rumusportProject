<?php

namespace App\Http\Controllers\API\About;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Skill;

class AboutController extends Controller
{
    public function getAuthorInfo()
    {
    	$info = About::paginate(10);

    	return response()->json($info);
    }



	public function getInfo()
    {
    	$info = About::all()->first();

    	return response()->json($info);
    }



    public function storeInfo(Request $request)
    {
    	$info = About::create([
            'name' => $request->name,
            'description' => $request->description,
            'work_info' => $request->work_info,
            'exp_info' => $request->exp_info,
            'personal_info' => $request->personal_info,
            'hobbies_info' => $request->hobbies_info,
            "image" => $request->image
        ]);

        $info->save();

        if($request->skills) {

            foreach (request('skills') as $skill) {
                Skill::where('id', $skill['id'])->first()->about()->attach($info->id);
            }
        }
    }



    public function updateInfo(Request $request, $id)
    {
        $info = About::where('id',$id)->first();
        $updatedInfo = $info->update([
           	'name' => $request->name,
            'description' => $request->description,
            'work_info' => $request->work_info,
            'exp_info' => $request->exp_info,
            'personal_info' => $request->personal_info,
            'hobbies_info' => $request->hobbies_info,
            "image" => $request->image
        ]);

        $info->save();

        if (isset(request()->skills)) {
            if($info->skills) {
                foreach ($info->skills as $skill) {
                    Skill::where('id', $skill['id'])->first()->about()->detach($info->id);
                }  
            }
            
            foreach (request('skills') as $skill) {
                Skill::where('id', $skill['id'])->first()->about()->attach($info->id);
            }
        }

        return response()->json($info);
    }



    public function deleteInfo($id)
    {
        $info = About::where('id', $id)->first();

        if($info->skills) {
            foreach ($info->skills as $skill) {
                Skill::where('id', $skill['id'])->first()->about()->detach($info->id);
            }  
        }

        $info->delete();

        return ['message'=>'Info was deleted'];
    }
}
