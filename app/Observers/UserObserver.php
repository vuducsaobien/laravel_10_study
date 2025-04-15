<?php

namespace App\Observers;

use App\Models\User;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Create new user - Cache
        $keyNewUser = CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $user->id);
        CacheHelper::set($keyNewUser, $user->toArray());

        // Delete key list user
        CacheHelper::del(CacheHelper::generateKey(CacheKeysEnum::LIST_USER));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Update key - User Detail
        $key = CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $user->id);
        CacheHelper::set($key, $user->toArray());

        // Delete key list user
        CacheHelper::del(CacheHelper::generateKey(CacheKeysEnum::LIST_USER));
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // Delete user By Id - Cache
        CacheHelper::del(CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $user->id));

        // Delete key list user
        CacheHelper::del(CacheHelper::generateKey(CacheKeysEnum::LIST_USER));
    }
} 