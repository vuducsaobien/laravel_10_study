<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Exception;
use App\Http\Request\Post\CreateRequest;
use App\Http\Request\Post\UpdateRequest;
use Throwable;
use App\Exceptions\Handler;
class PostController extends BaseController
{
    public $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Get List Posts
     */
    public function getListPosts(): JsonResponse
    {
        try {
            $result = $this->postService->getAllPosts();
            
            return $this->successBase($result, __('message.post.retrieved_successfully'));
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    /**
     * Get User By Id
     */
    public function getPostById(int $id): JsonResponse
    {
        try {
            $result = $this->postService->getPostById($id);
            
            return $this->successBase($result, __('message.post.retrieved_successfully'));
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    /**
     * Create Post
     */
    public function createPost(CreateRequest $request): JsonResponse
    {
        try {
            $params = $request->all();
            $result = $this->postService->createPost($params);
            
            return $this->successBase($result, __('message.post.created_successfully'));
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    /**
     * Update Post
     */
    public function updatePost(UpdateRequest $request, int $id): JsonResponse
    {
        try {
            $params = $request->all();
            $result = $this->postService->updatePost($id, $params);
            
            return $this->successBase($result, __('message.post.updated_successfully'));
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    /**
     * Delete Post
     */
    public function deletePost(int $id): JsonResponse
    {
        try {
            $result = $this->postService->deletePost($id);
            
            return $this->successBase($result, __('message.post.deleted_successfully'));
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }
}
