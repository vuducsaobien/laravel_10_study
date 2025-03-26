<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    // protected $fillable = ['user_id', 'detail'];
    public $timestamps = FALSE;

    public function users() // Many to Many
    {
        return $this->belongsToMany(User::class, 'users_products', 'product_id', 'user_id')
        ->withPivot('quantity')
        ;
    }

    
}
