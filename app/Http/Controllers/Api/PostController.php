<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class PostController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth:sanctum',
            new Middleware('permission:view post', only: ['index', 'show']),
            new Middleware('permission:create post', only: ['store']),
            new Middleware('permission:update post', only: ['update']),
            new Middleware('permission:delete post', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of posts.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $posts = Post::with('categories')->latest()->get();

            return response()->json([
                'success' => true,
                'message' => 'Posts retrieved successfully',
                'data' => PostResource::collection($posts)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created post.
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $post = Post::create($request->validated());

            if ($request->has('category_ids')) {
                $post->categories()->attach($request->input('category_ids'));
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Post created successfully',
                'data' => new PostResource($post->load('categories'))
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified post.
    *
    * @param Post $post
    * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Post retrieved successfully',
                'data' => new PostResource($post->load('categories'))
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified post.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(PostRequest $request, Post $post): JsonResponse
    {
        DB::beginTransaction();
        try {
            $post->update($request->validated());
            if ($request->has('category_ids')) {
                $post->categories()->sync($request->input('category_ids'));
            } else {
                $post->categories()->detach();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully',
                'data' => new PostResource($post->fresh()->load('categories'))
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified post.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        DB::beginTransaction();
        try {
            $post->categories()->detach();
            $post->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete post',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
