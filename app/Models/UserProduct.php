<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserProduct extends Model
{
    use HasFactory;

    protected $table = 'users_products';
    // protected $fillable = ['user_id', 'detail'];
    public $timestamps = FALSE;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total_price',
    ];

    public function user() // Many to Many của bảng Trung gian
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product() // Many to Many của bảng Trung gian
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getUniqueUsersByProductId($productId)
    {
        return $this->where('product_id', $productId)
        // ->select('*') // Chỉ lấy cột user_id
        ->select('user_id') // Chỉ lấy cột user_id
        ->groupBy('user_id') // Nhóm theo user_id để loại bỏ trùng lặp
        // ->pluck('user_id') // Lấy danh sách user_id không trùng lặp
        ->with('user')
        ->get()
        ;
    }

    public function getUniqueProductsByUserId($userId)
    {
        return $this->where('user_id', $userId)
        // ->select('*') // Chỉ lấy cột user_id
        ->select('product_id') // Chỉ lấy cột user_id
        ->groupBy('product_id') // Nhóm theo user_id để loại bỏ trùng lặp
        // ->pluck('user_id') // Lấy danh sách user_id không trùng lặp
        ->with('product')
        ->get()
        ;
    }
}
