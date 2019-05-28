<?php

namespace App\Http\Controllers\Api\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use  Auth;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $user = Auth::user();
        dd($user);
    	$name = request()->name;

        if($name){
            $categories = Category::where('name', 'like', '%' . $name . '%')->paginate(10);
        }else{
            if (request()->paginate == 1) {
                $categories = Category::paginate(10);
            }else{
                 $categories = Category::all();
            }
            
        }

        return response()->json($categories);
    }



    public function storeCategory(Request $request)
    {
    	 $newCategory = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $category = Category::create($newCategory);

        return response()->json($category);
    }



    public function getCategory($id)
    {
        $category = Category::where('id', $id)->first();

        return response()->json($category);
    }



    public function updateCategory(Request $request, $id)
    {
         $newCategory = request()->validate([
            'name' => 'required|max:255',
            'subtitle' => 'nullable',
            'description' => 'nullable',
            'image' => 'required'
        ]);

        Category::where('id', $id)->update($newCategory);

        return response()->json(Category::find($id));
    }



    public function deleteCategory($id)
    {
        Category::destroy($id);

        $categories = Category::all();
        return response()->json($categories);
    }

}
