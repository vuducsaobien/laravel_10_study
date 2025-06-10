<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Table_2;
use App\Models\Table_4;

class Table_1 extends Model
{
    use HasFactory;

    protected $table = 'table_1';
    protected $fillable = ['name'];
    public $timestamps = FALSE;

    public function table_2() // One to One
    {
        return $this->hasOne(Table_2::class, 'table_1_id');
    }

    public function table_3() // One to Many
    {
        return $this->hasMany(Table_3::class, 'table_1_id');
    }

    public function table_4() // Many to Many
    {
        return $this->belongsToMany(Table_4::class, 'table_1_4', 'table_1_id', 'table_4_id');
    }
}
