<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phones';
    protected $fillable = ['user_id', 'detail'];
    public $timestamps = FALSE;

    public function user() // One to Many
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
