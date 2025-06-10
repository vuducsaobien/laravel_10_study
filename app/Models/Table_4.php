<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Table_4 extends Model
{
    use HasFactory;

    protected $table = 'table_4';
    protected $fillable = ['name'];
    public $timestamps = FALSE;

    public function table_1() // Many to Many
    {
        return $this->belongsToMany(Table_1::class, 'table_1_4', 'table_4_id', 'table_1_id');
    }
} 