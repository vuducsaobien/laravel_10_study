<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Product extends BaseModel
{
    use HasFactory;

    protected $table = 'products';
    // protected $fillable = ['user_id', 'detail'];
    public $timestamps = FALSE;
    private $__perPage = 2;

    public function users() // Many to Many
    {
        return $this->belongsToMany(User::class, 'users_products', 'product_id', 'user_id')
        ->withPivot('quantity')
        ;
    }

    public function findByProductIdModel($productId)
    {
        return $this->find($productId);
    }

    public function paginationPage($page)
    {
        return $this->paginate($this->__perPage, ['*'], 'page', $page);
    }

    
}
