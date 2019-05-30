<?php

namespace App\Http\Controllers\API\Skills;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Skill;

class SkillController extends Controller
{
    public function allSkills()
    {
    	$skills = Skill::paginate(10);

    	return response()->json($skills);
    }





    public function storeSkill(Request $request)
    {
    	$skill = Skill::create([
    		'name' => $request->name
    	]);
    	$skill->save();

    	return response()->json($skill);
    }





    public function updateSkill(Request $request, $id)
    {
    	$skill = Skill::where('id', $id)->update([
    		'name' => $request->name
    	]);
    	$skill->save();

    	return response()->json($skill);
    }





    public function deleteSkill($id)
    {
    	Skill::where('id', $id)->delete();

    	$skills = Skill::paginate(10);

    	return response()->json($skills);
    }
}
