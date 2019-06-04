<?php

namespace App\Http\Controllers\API\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class NewsController extends Controller
{
    public function getAllNews()
    {
    	$articles = Article::paginate(10);

        return response()->json($articles);
    }





    public function storeArticle(Request $request)
    {
    	$newArticle = $request->validate([
            'description' => 'required',
            'image' => 'required',
        ]);

        $article = Article::create($newArticle);

        return response()->json($article);
    }





    public function getLastArticle()
    {
         $article = Article::orderBy('id', 'desc')->first();  

         return response()->json($article);   
    }





    public function getArticle($id)
    {
    		//
    }





    public function updateArticle(Request $request, $id)
    {
    	//		
    }





    public function deleteArticle($id)
    {
    	//		
    }
}
