<?php

namespace App\Observers;

use App\Models\User;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;
use App\Services\UserService;
use App\Services\CacheService;
class UserObserver
{
    private $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->cacheService->handleUserAfterCreateAndUpdate($user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Flush all Redis cache
        CacheHelper::flushAll();
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // Flush all Redis cache
        CacheHelper::flushAll();
    }
} 