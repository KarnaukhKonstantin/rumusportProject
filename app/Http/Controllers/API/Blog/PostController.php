<?php

namespace App\Http\Controllers\API\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Link;
use App\Models\Tag;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{
    public function getAllPosts()
    {
    	$title = request()->title;

        if($title){
            $posts = Post::where('title', 'like', '%' . $title . '%')->paginate(10);
        }else{
            if (request()->paginate == 1) {
                $posts = Post::paginate(10);
            }else{
                 $posts = Post::all();
            }
            
        }

        return response()->json($posts);
    }



    // public function getMainPosts()
    // {
    //      $posts = Post::where('id', '<', 4)->get();

    //      return response()->json($posts);   
    // }



    public function storePost(Request $request)
    {
    	$post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'category_id' => $request->category_id,
            'image' => $request->image,
            'author_id' => $request->author_id
        ]);

        $post->save();

        if($request->links) {

            $links = $request->links;
            foreach($links as $link) {
                Link::create([
                    'body' => $link['body'],
                    'post_id' => $post->id
                ]);
            }
        }
        if($request->tags) {

            foreach (request('tags') as $tag) {
                Tag::where('id', $tag['id'])->first()->posts()->attach($post->id);
            }
        }

        return response()->json($post);
    }






    public function getPost($id)
    {
        $post = Post::where('id', $id)->first();    

        return response()->json($post);   
    }






    public function updatePost(Request $request, $id)
    {
        $post = Post::where('id',$id)->first();
        $updatedPost = $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'category_id' => $request->category_id,
            'image' => $request->image,
            'author_id' => $request->author_id
        ]);

        $post->save();

        if (isset(request()->links)) {
            $post_links = $post->links;
            if($post_links) {
                foreach($post_links as $post_link) {
                    Link::destroy($post_link->id);
                }
            }

            $links = $request->links;
            foreach($links as $link) {
                Link::create([
                    'body' => $link['body'],
                    'post_id' => $id
                ]);
            }
        }

        if (isset(request()->tags)) {
            if($post->tags) {
                foreach ($post->tags as $tag) {
                    Tag::where('id', $tag['id'])->first()->posts()->detach($post->id);
                }  
            }
            
            foreach (request('tags') as $tag) {
                Tag::where('id', $tag['id'])->first()->posts()->attach($post->id);
            }
        }

        return response()->json($post);
    }





    public function deletePost($id)
    {
        $post = Post::where('id', $id)->first();

        if($post->tags) {
            foreach ($post->tags as $tag) {
                Tag::where('id', $tag['id'])->first()->posts()->detach($post->id);
            }  
        }

        $post->delete();

        return ['message'=>'Post was deleted'];
    }

}
