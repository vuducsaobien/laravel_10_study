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
        // return $this->where('product_id', $productId)->distinct('user_id')
        //     ->with('user') // Lấy thêm thông tin user (name, ...)
        //     ->get();

        // return User::select('name')->distinct()->get();

        return DB::table('users')
            ->select('id','name', 'email')
            ->groupBy('name')
            ->get();
    }

    public function getUniqueProductsByUserId($userId)
    {
        // return $this->where('user_id', $userId)->distinct('product_id')->get();

        return $this->where('user_id', $userId)
        // ->select('product_id') // Chỉ lấy product_id
        ->select(['id', 'product_id', 'user_id']) // Chỉ lấy product_id
        ->groupBy('product_id') // Nhóm theo product_id để tránh trùng lặp
        ->with('product') // Lấy thêm thông tin của sản phẩm
        ->get();
    }
}
