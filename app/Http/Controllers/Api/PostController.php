<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;
use App\Traits\ApiResponseTrait;

class PostController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        protected PostService $postService
    ) {}

    public function index()
    {
        return $this->successResponse(
            $this->postService->getAll(),
            'All posts retrieved successfully'
        );
    }

    public function store(StorePostRequest $request)
    {
        $post = $this->postService->create(
            $request->validated()
        );

        return $this->successResponse(
            $post,
            'Post created successfully',
            201
        );
    }

    public function show(string $id)
    {
        return $this->successResponse(
            $this->postService->getById((int) $id),
            'Post retrieved successfully'
        );
    }

    public function update(
        UpdatePostRequest $request,
        string $id
    ) {
        $post = $this->postService->update(
            (int) $id,
            $request->validated()
        );

        return $this->successResponse(
            $post,
            'Post updated successfully'
        );
    }

    public function destroy(string $id)
    {
        $this->postService->delete((int) $id);

        return $this->successResponse(
            null,
            'Post deleted successfully'
        );
    }
}