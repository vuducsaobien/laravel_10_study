<?php
namespace App\Redis;

use Illuminate\Redis\RedisManager;
use RedisException;

class SafeRedisManager extends RedisManager
{
    public function connection($name = null)
    {
        try {
            return parent::connection($name);
        } catch (RedisException $e) {
            // Ghi log lỗi nếu cần
            logger()->warning('Redis connection failed: ' . $e->getMessage());

            // Trả về mock/fake redis (hoặc null object)
            return new class {
                public function __call($method, $args)
                {
                    return null;
                }
            };
        }
    }
}
