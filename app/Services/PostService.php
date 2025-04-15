<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;
use Throwable;
use App\Exceptions\Handler;
class PostService
{
    const PER_PAGE = 10;
    
    /**
     * Get All Posts
     */
    public static function getAllPosts()
    {
        $key = CacheHelper::generateKey(CacheKeysEnum::LIST_POST);
        $result = Post::getFromCacheOrSet($key, function () {
            // die('PostService - khong co Cache - getAllPosts');
            return (new Post())->getAllPosts()->toArray();
        });

        return $result;
    }

    public static function getPostById(int $id)
    {
        $key = CacheHelper::generateKey(CacheKeysEnum::POST_BY_ID, $id);
        $result = Post::getFromCacheOrSet($key, function () use ($id) {
            die('PostService - khong co Cache - getPostById');
            return Post::getPostById($id)->toArray();
        });

        return $result;
    }

    public static function createPost(array $data): Model
    {
        return Post::create($data);
    }

    public static function updatePost(int $id, array $data): bool
    {
        $post = Post::find($id);
        if (!$post) {
            return false;
        }
        if (!isset($data['author_id'])) {
            $data['author_id'] = NULL;
        }
        return $post->update($data);
    }

    public static function deletePost(int $id): bool
    {
        $post = Post::find($id);
        if (!$post) {
            return false;
        }
        return $post->delete();
    }

    public static function handlePostObserverAfterCreateAndUpdate(Post $post)
    {
        try {
            // Create new post - Cache
            $key = CacheHelper::generateKey(CacheKeysEnum::POST_BY_ID, $post->id);
            $post->load('author');
            CacheHelper::set($key, $post->toArray());
    
            // Delete key list post
            CacheHelper::del(CacheHelper::generateKey(CacheKeysEnum::LIST_POST));
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

}
