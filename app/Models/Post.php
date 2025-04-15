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

    // Scopes
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
