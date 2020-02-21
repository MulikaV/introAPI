<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy');

        if (isset($sortBy)){
            $order = $request->input('order');
            return Post::with('user')->orderBy($sortBy,$order)->get();
        } else{
            return Post::with('user')->get();
        }
    }

    public function store(Request $request)
    {

        $post = Post::add($request->toArray());
        return response()->json($post, 201);
    }

    public function show($id)
    {
        Post::find($id);
    }

    public function destroy($id)
    {
        Post::find($id) ->remove();
    }
}
