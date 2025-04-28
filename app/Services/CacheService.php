<?php

namespace App\Services;

use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;
use Throwable;
use App\Exceptions\Handler;
use App\Models\User;
class CacheService
{
    public function handleUserAfterCreateAndUpdate(User $user)
    {
        try {
            // Create new user - Cache
            $key = CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $user->id);
            CacheHelper::set($key, $user->toArray());

            $this->deleteUserListCache();
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    public function deleteUserListCache()
    {
        try {
            CacheHelper::del(CacheHelper::generateKey(CacheKeysEnum::USER_LIST));
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    public function deleteUserByIdCache(int $id)
    {
        try {
            $key = CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $id);
            CacheHelper::del($key);
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    public function setUserByIdCache(User $user)
    {
        try {
            $key = CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $user->id);
            CacheHelper::set($key, $user->toArray());
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }






}
