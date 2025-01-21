<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Table1 extends Model
{
    use HasFactory;

    protected $table = 'table_1';
    protected $fillable = ['name', 'age'];
    public $timestamps = FALSE;
}
