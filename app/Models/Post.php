<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
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
