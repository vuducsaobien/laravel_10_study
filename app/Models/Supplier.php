<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\History;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = ['name'];
    public $timestamps = FALSE;

    public function user() // has One Through
    {
        return $this->hasOne(User::class);
    }

    public function userHistory() // has One Through
    {
        return $this->hasOneThrough(History::class, User::class);
    }
}
