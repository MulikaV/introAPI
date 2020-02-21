<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', null);
        $order = $request->input('order', null);

        $posts = Post::with('user');

        if ($sortBy && $order) {
            $posts->orderBy($sortBy, $order);
        } else if ($sortBy) {
            $posts->orderBy($sortBy);
        }

        return $posts->get();

    }

    public function store(Request $request)
    {

        $post = Post::create($request->toArray());
        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->toArray());

    }

    public function show($id)
    {
        Post::find($id);
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
    }
}
