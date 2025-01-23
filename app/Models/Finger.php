<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Finger extends Model
{
    use HasFactory;

    protected $table = 'fingers';
    protected $fillable = ['user_id', 'detail'];
    public $timestamps = FALSE;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
