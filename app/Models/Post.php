<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
class Post extends BaseModel
{
    use HasFactory;
    // Mỗi bài viết phải có title, content, authorId, createdAt, updatedAt
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'author_id'];
    public $timestamps = TRUE;

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Get Author
    public function getAuthorAttribute()
    {
        return $this->author();
    }

    public static function getAllPosts()
    {
        return self::select('id', 'title', 'content', 'author_id')->with('author')->get();
    }

    public static function getPostById(int $id)
    {
        return self::select('title', 'content', 'author_id')->with('author')->find($id);
    }

    public static function createPost(array $data)
    {
        return self::create($data);
    }

    public static function updatePost(int $id, array $data)
    {
        return self::find($id)->update($data);
    }
    
    
    

}
