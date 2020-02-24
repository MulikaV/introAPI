<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function index(Request $request)
    {
       return Post::getAllPosts($request);
    }

    public function store(StorePost $request)
    {
        Post::create($request->toArray());
    }

    public function update(StorePost $request, Post $post)
    {
        $post->update($request->toArray());
    }

    public function destroy(Post $post)
    {
        $post->delete();
    }
}
