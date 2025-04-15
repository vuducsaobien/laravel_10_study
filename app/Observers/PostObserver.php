<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\User;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;
use App\Services\PostService;
class PostObserver
{
    public $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $this->postService->handlePostObserverAfterCreateAndUpdate($post);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $this->postService->handlePostObserverAfterCreateAndUpdate($post);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Post $post): void
    {
        // Delete post By Id - Cache
        CacheHelper::del(CacheHelper::generateKey(CacheKeysEnum::POST_BY_ID, $post->id));

        // Delete key list post
        CacheHelper::del(CacheHelper::generateKey(CacheKeysEnum::LIST_POST));
    }
} 