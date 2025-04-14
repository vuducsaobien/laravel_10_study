<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Exception;
use App\Http\Request\Post\CreateRequest;
use App\Http\Request\Post\UpdateRequest;
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
            $result = $this->postService->getAllPostsPaginate();
            
            return $this->successBase($result, config('messages.post.retrieved_successfully'));
        } catch (Exception $e) {
            return $this->errorBase(config('messages.post.unexpected_error_occurred'), 500);
        }
    }

    /**
     * Get User By Id
     */
    public function getPostById(int $id): JsonResponse
    {
        try {
            $result = $this->postService->getPostById($id);
            
            return $this->successBase($result, config('messages.post.retrieved_successfully'));
        } catch (Exception $e) {
            return $this->errorBase(config('messages.post.unexpected_error_occurred'), 500);
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
            
            return $this->successBase($result, config('messages.post.created_successfully'));
        } catch (Exception $e) {
            return $this->errorBase(config('messages.post.unexpected_error_occurred'), 500);
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
            
            return $this->successBase($result, config('messages.post.updated_successfully'));
        } catch (Exception $e) {
            return $this->errorBase(config('messages.post.unexpected_error_occurred'), 500);
        }
    }

    /**
     * Delete Post
     */
    public function deletePost(int $id): JsonResponse
    {
        try {
            $result = $this->postService->deletePost($id);
            
            return $this->successBase($result, config('messages.post.deleted_successfully'));
        } catch (Exception $e) {
            return $this->errorBase(config('messages.post.unexpected_error_occurred'), 500);
        }
    }
}
