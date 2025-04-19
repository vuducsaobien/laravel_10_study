<?php

namespace App\Helpers;

use App\Enum\CacheKeysEnum;
use App\Helpers\RedisCacheHelper;

class CacheHelper
{
    private static function getCacheInterface()
    {
        return RedisCacheHelper::class;
    }

    public static function set($key, $value)
    {
        try {
            // Serialize the value if it's an array
            $value = is_array($value) ? json_encode($value) : $value;
            self::getCacheInterface()::set($key, $value, config('my_config.cache_time_expired'));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function get($key)
    {
        try {
            $value = self::getCacheInterface()::get($key);
            // Try to decode JSON if the value is a string
            if (is_string($value)) {
                $decoded = json_decode($value, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    return $decoded;
                }
            }
            return $value;
        } catch (\Exception $e) {
            return null;
        }
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

    public static function getKeys($pattern)
    {
        try {
            return self::getCacheInterface()::getKeys($pattern);
        } catch (\Exception $e) {
            return [];
        }
    }

    public static function flushAll()
    {
        return self::getCacheInterface()::flushAll();
    }

    public static function getFromCacheOrSet($key, $callback)
    {
        $value = self::get($key);
        if (!$value) {
            $value = $callback();
            self::set($key, $value);
            return $value;
        }
        return $value;
    }
}
