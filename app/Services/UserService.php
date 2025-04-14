<?php

namespace App\Services;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserService extends ServiceProvider
{
    const PER_PAGE = 10;

    /**
     * Get List Users
     */
    public function getListUsers(): Collection
    {
        return User::getListUsersPaginate(self::PER_PAGE);
    }

    public function getUserById(int $id): Model
    {
        return User::getUserById($id);
    }

    public function createUser(array $data): Model
    {
        return User::createUser($data);
    }

    public function updateUser(int $id, array $data): Model
    {
        return User::updateUser($id, $data);
    }

    public function deleteUser(int $id): Model
    {
        return User::deleteUser($id);
    }
}
