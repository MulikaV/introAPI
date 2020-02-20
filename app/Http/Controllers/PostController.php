<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
    {

        $post = Post::add($request->toArray());
        return response()->json($post, 201);
    }

    public function destroy($id)
    {
        Post::find($id) ->remove();
    }
}
