<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Plan;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';
    // protected $fillable = ['user_id', 'detail'];
    public $timestamps = FALSE;

    public function plan() // Has One Through
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    // Scopes
    public function scopeValid($query) 
    {
        return $query->where('end_at', '>', now());
    }
    
}
