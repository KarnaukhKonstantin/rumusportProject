<?php

namespace App\Http\Controllers\Api\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
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
}
