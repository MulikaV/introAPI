<?php

namespace App\Http\Controllers;


use App\Http\Requests\Post\StorePost;
use App\Models\Post;

class PostController extends Controller
{



    public function index()
    {
        return Post::getAllPosts();
    }

    public function store(StorePost $request)
    {
        $post = Post::create($request->all());
        return response()->json($post, 200);

    }

    public function update(StorePost $request, Post $post)
    {

        $post->update($request->toArray());
        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();
    }
}
