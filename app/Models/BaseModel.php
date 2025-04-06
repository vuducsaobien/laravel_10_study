<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;

class BaseModel extends Model
{
    public static function getFromCacheOrSet($key, $callback)
    {
        $value = CacheHelper::get($key);
        if (!$value) {
            $value = $callback();
            CacheHelper::set($key, serialize($value));
        }
        return unserialize(CacheHelper::get($key));
    }
}
