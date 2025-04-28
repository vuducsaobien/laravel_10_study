<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get all users
     * 
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->select('id', 'name', 'email')->get();
    }

    /**
     * Get all users with posts
     * 
     * @return Collection
     */
    public function getAllWithPosts(): Collection
    {
        return $this->model->with('posts')->get();
    }

    /**
     * Find user by ID
     * 
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return $this->model->find($id);
    }

    /**
     * Find user by ID with posts
     * 
     * @param int $id
     * @return User|null
     */
    public function findByIdWithPosts(int $id): ?User
    {
        return $this->model->with('posts')->find($id);
    }

    /**
     * Create user
     * 
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return $this->model->create($data);
    }

    /**
     * Update user by ID
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $user = $this->findById($id);
        return $user->update($data);
    }

    /**
     * Update user with lock to avoid race condition.
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateWithLock(int $id, array $data): bool
    {
        $user = $this->getUserWithLock($id);
        return $user->update($data);
    }

    /**
     * Get user with lock to avoid race condition.
     * 
     * @param int $id
     * @return User
     */
    protected function getUserWithLock(int $id): User
    {
        return $this->model->lockForUpdate()->findOrFail($id);
    }

    /**
     * Delete user by ID
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $user = $this->getUserWithLock($id);
        return $user->delete();
    }
} 