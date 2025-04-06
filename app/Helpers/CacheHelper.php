<?php

namespace App\Helpers;

use App\Enum\CacheKeysEnum;

class CacheHelper
{
    public static int $CACHE_TIME_EXPIRED;

    private static function getCacheInterface()
    {
        return RedisCacheHelper::class;
    }

    public static function init(): void
    {
        self::$CACHE_TIME_EXPIRED = config('my_config.cache_time_expired');
    }

    public static function set($key, $value)
    {
        try {
            return self::getCacheInterface()::set($key, $value, self::$CACHE_TIME_EXPIRED);
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function get($key)
    {
        return self::getCacheInterface()::get($key);
    }

    public static function exists($key)
    {
        return self::getCacheInterface()::exists($key);
    }

    public static function del($key)
    {
        return self::getCacheInterface()::del($key);
    }

    public static function generateKey(CacheKeysEnum $pattern, ...$params): string
    {
        return sprintf($pattern->value, ...$params);
    }
}
