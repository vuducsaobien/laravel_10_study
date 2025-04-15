<?php

namespace App\Observers;

use App\Models\User;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;
use App\Services\UserService;
class UserObserver
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->userService->handleUserObserverAfterCreateAndUpdate($user);
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