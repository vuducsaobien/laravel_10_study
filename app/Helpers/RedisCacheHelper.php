<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

class RedisCacheHelper implements CacheInterface
{
    private static $redis = null;

    public static function init()
    {
        if (self::$redis === null) {
            try {
                self::$redis = Redis::client();
            } catch (\Exception $e) {
                Log::error('Redis connection failed: ' . $e->getMessage());
                throw $e;
            }
        }
    }

    public static function set($key, $value, $expired)
    {
        try {
            self::init();
            return self::$redis->set($key, $value, $expired);
        } catch (\Exception $e) {
            Log::error('Redis set failed: ' . $e->getMessage());
            return false;
        }
    }

    public static function get($key)
    {
        try {
            self::init();
            return self::$redis->get($key);
        } catch (\Exception $e) {
            Log::error('Redis get failed: ' . $e->getMessage());
            return false;
        }
    }

    public static function exists($key)
    {
        try {
            self::init();
            return self::$redis->exists($key);
        } catch (\Exception $e) {
            Log::error('Redis exists failed: ' . $e->getMessage());
            return false;
        }
    }

    public static function del($key)
    {
        try {
            self::init();
            return self::$redis->del($key);
        } catch (\Exception $e) {
            Log::error('Redis del failed: ' . $e->getMessage());
            return false;
        }
    }
}
