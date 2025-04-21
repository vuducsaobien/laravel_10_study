<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;
use Throwable;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\DB;
use App\Exceptions\BusinessException;
use App\Models\User;
class CacheService
{
    public function handleUserAfterCreateAndUpdate(User $user)
    {
        try {
            // Create new user - Cache
            $key = CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $user->id);
            CacheHelper::set($key, $user->toArray());

            // Delete key list user
            CacheHelper::del(CacheHelper::generateKey(CacheKeysEnum::USER_LIST));
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }


}
