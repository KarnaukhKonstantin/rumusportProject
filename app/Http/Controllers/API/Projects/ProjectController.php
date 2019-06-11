<?php

namespace App\Http\Controllers\API\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;

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
