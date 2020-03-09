<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{

    /**Get all posts with User
     *
     * @return LengthAwarePaginator
     */
    public function index()
    {
        return Post::with('user:id,username')->latest()->paginate(13);
    }

    /**
     * Store posts
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        $user = $request->user();
        return $user->posts()->save(new Post($request->all()));
    }

    /**
     * Update posts
     *
     * @param PostRequest $request
     * @param $id
     * @return Exception|JsonResponse
     */
    public function update(PostRequest $request, $id)
    {
        $user = $request->user();

        if (!$post = $user->posts()->find($id)) {
            throw new NotFoundHttpException('This user can\'t modify this post');
        }

        $post->update($request->all());
        return $post;
    }

    /**
     * Delete Posts
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        if (!$post = $user->posts()->find($id)) {
            throw new NotFoundHttpException('This user can\'t modify this post');
        }

        $post->delete();
    }


}
