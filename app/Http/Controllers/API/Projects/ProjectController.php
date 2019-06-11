<?php

namespace App\Http\Controllers\API\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Skill;
use App\Models\Link;

class ProjectController extends Controller
{
    public function getAllProjects()
    {
    	$projects = Project::paginate(10);

    	return response()->json($projects);
    }





    public function getProjectsWithoutPaginate()
    {
    	$projects = Project::all();

    	return response()->json($projects);
    }





    public function getProject($id)
    {
    	$project = Project::where('id', $id)->first();

    	return response()->json($project);
    }




    
    public function storeProject(Request $request)
    {
    	$project = Project::create([
            'name' => $request->name,
            'main_description' => $request->main_description,
            'secondary_description' => $request->secondary_description,
            'category_id' => $request->category_id,
            'image' => $request->image,
        ]);

        $project->save();

        if($request->links) {

            $links = $request->links;
            foreach($links as $link) {
                Link::create([
                    'body' => $link['body'],
                    'project_id' => $project->id
                ]);
            }
        }

        if($request->tags) {

            foreach (request('tags') as $tag) {
                Tag::where('id', $tag['id'])->first()->posts()->attach($project->id);
            }
        }

        if($request->skills) {

            foreach (request('skills') as $skill) {
                Skill::where('id', $skill['id'])->first()->about()->attach($project->id);
            }
        }
    }





    public function updateProject(Request $request, $id)
    {
    			
    }





    public function deleteProject($id)
    {
    	Project::where('id', $id)->delete();

    	$projects = Project::paginate(10);

    	return response()->json($projects);	
    }
}
