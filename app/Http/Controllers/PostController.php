<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**Get all posts with User
     *
     * @return LengthAwarePaginator
     */
    public function index()
    {
        return Post::with('user')->latest()->paginate(5);
    }


    /**
     * Store posts
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
            $post = Auth::user()->posts()->create($request->all());
            return response()->json($post, 201);
    }

    /**
     * Updating Posts
     *
     *
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->all());
        return response()->json($post, 201);
    }

    /**Deleting Posts
     *
     *
     * @param Post $post
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return response()->json([
            'message' => 'Post successfully deleted'
        ]);
    }


}
