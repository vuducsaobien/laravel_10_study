<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plans';
    protected $fillable = ['name', 'price'];
    public $timestamps = FALSE;

    // Scopes
    public function scopeStatusActive($query)
    {
        return $query->where('status', 'active');
    }
}
