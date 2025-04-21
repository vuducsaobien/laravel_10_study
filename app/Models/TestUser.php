<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class TestUser extends BaseModel
{
    use HasFactory;
    // Mỗi bài viết phải có title, content, authorId, createdAt, updatedAt
    protected $table = 'test_users';
    protected $fillable = ['name', 'email'];
    public $timestamps = FALSE;

    

}
