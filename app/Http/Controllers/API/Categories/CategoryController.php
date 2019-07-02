<?php

namespace App\Http\Controllers\Api\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
// use App\Models\News;

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



    public function categoriesWithoutPagination()
    {
        $categories = Category::all();

        foreach($categories as $category) {
            $tags = Tag::where('category_id', $category->id)->get();
            $category->tags = $tags;
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

        $posts = Post::where('category_id', $category->id)->get();
        $projects  = Project::where('category_id', $category->id)->get();
        // $news = News::where('category_id', $category->id)->get();

        return response()->json(['category' => $category, 'posts' => $posts, 'projects' => $projects]);
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
