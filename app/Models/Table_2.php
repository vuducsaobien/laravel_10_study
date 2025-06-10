<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Table_1;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Table_2 extends Model
{
    use HasFactory;

    protected $table = 'table_2';
    protected $fillable = ['name', 'table_1_id'];
    public $timestamps = FALSE;

    public function table_1(): BelongsTo // One to One
    {
        return $this->belongsTo(Table_1::class, 'table_1_id');
    }
    
}
