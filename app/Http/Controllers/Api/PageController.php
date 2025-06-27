<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PageController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            // Ensure auth:sanctum is applied if using API tokens
            'auth:sanctum',
            new Middleware('permission:view page', only: ['index', 'show']),
            new Middleware('permission:create page', only: ['store']),
            new Middleware('permission:update page', only: ['update']),
            new Middleware('permission:delete page', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of pages.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $pages = Page::latest()->get();

            return response()->json([
                'success' => true,
                'message' => 'Pages retrieved successfully',
                'data' => PageResource::collection($pages)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve pages',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created page.
     *
     * @param PageRequest $request
     * @return JsonResponse
     */
    public function store(PageRequest $request): JsonResponse
    {
        try {
            $page = Page::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Page created successfully',
                'data' => new PageResource($page)
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create page',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified page.
    *
    * @param Page $page
    * @return JsonResponse
     */
    public function show(Page $page): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Page retrieved successfully',
                'data' => new PageResource($page)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve page',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified page.
     *
     * @param PageRequest $request
     * @param Page $page
     * @return JsonResponse
     */
    public function update(PageRequest $request, Page $page): JsonResponse
    {
        try {
            $page->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Page updated successfully',
                'data' => new PageResource($page->fresh())
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update page',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified page.
     *
     * @param Page $page
     * @return JsonResponse
     */
    public function destroy(Page $page): JsonResponse
    {
        try {
            $page->delete();

            return response()->json([
                'success' => true,
                'message' => 'Page deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete page',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
