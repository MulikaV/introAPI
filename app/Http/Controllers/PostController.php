<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        return Post::with('user')->latest()->get();
    }


    public function store(PostRequest $request)
    {
            $post = Auth::user()->posts()->create($request->all());
            return response()->json($post, 201);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->all());
        return response()->json($post, 201);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return response()->json([
            'message' => 'Post successfully deleted'
        ]);
    }


}
