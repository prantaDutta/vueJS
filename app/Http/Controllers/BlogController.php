<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getAllBlogPost(){
        $posts = Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'posts' => $posts
        ],200);
    }

    public function singlePost($id){
        $singlePost = Post::with('user','category')->where('id', $id)->get();
        return response()->json([
            'singlePost' => $singlePost
        ],200);
    }

    public function categories(){
        $categories = Category::with('user','post')->orderBy('id','desc')->get();
        return response()->json([
            'categories' => $categories
        ],200);
    }

    public function categoryPost($id){
        $posts = Post::with('user','category')->where('cat_id', $id)->orderBy('id','desc')->get();
        return response()->json([
            'posts' => $posts
        ],200);
    }

    public function searchPost(){
        $search = \Request::get('s');
        if ($search != null){
            $posts = Post::with('user','category')
                ->where('title', 'LIKE',"%$search%")
                ->orWhere('description', 'LIKE',"%$search%")
                ->get();
            return response()->json([
                'posts' => $posts
            ],200);
        }
        else{
            return $this->getAllBlogPost();
        }
    }

    public function latestPost(){
        $posts = Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'posts' => $posts
        ],200);
    }
}
