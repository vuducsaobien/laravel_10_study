<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory;
    protected $table = 'history';
    protected $fillable = ['user_id'];
    public $timestamps = FALSE;

    public function user() // has One Through
    {
        return $this->belongsTo(User::class);
    }
}
