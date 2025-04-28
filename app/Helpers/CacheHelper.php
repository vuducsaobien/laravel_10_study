<?php

namespace App\Helpers;

use App\Enum\CacheKeysEnum;
use App\Helpers\RedisCacheHelper;
use App\Enum\CacheDataTypeEnum;
class CacheHelper
{
    private static function getCacheInterface()
    {
        return RedisCacheHelper::class;
    }

    public static function set($key, $value)
    {
        try {
            // Serialize the value if it's an array or object
            if (is_array($value) || is_object($value)) {
                $value = serialize($value);
            }
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
            // Try to unserialize if the value is a serialized string
            if (is_string($value)) {
                $unserialized = @unserialize($value);
                if ($unserialized !== false) {
                    return $unserialized;
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

    public static function getFromCacheOrSet($key, $callback, $ttl = null)
    {
        if (self::exists($key)) {
            return self::get($key);
        }

        $value = $callback();
        self::set($key, $value, $ttl);
        // return $value;
        return self::get($key);
    }

    public static function returnCachedResult($data, string $dataType = '')
    {
        $dataTypeChoosen = $dataType ?? config('my_config.cache_data_type');

        if ($dataTypeChoosen === CacheDataTypeEnum::ARRAY) {
            return $data->toArray() ?? [];
        }

        return $data ?? returnEmptyObject();
    }

    public static function returnCachedEmptyInit()
    {
        if (config('my_config.cache_data_type') === CacheDataTypeEnum::ARRAY) {
            return [];
        }
        return returnEmptyObject();
    }

}
