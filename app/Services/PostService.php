<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostService
{
    const PER_PAGE = 10;
    
    /**
     * Get All Posts
     */
    public static function getAllPosts()
    {
        return Post::with('author')->get();
    }

    /**
     * Get All Posts
     */
    public static function getAllPostsPaginate(int $perPage)
    {
        return Post::with('author')->paginate($perPage);
    }

    public static function getPostById(int $id): ?Model
    {
        return Post::with('author')->find($id);
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
}
