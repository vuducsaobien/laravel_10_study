<?php

namespace App\Helpers;

interface CacheInterface
{
    public static function set($key, $value, $expired);
    public static function get($key);
    public static function exists($key);
    public static function del($key);
} 