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

    public function getAll(): Collection
    {
        return $this->model->select('id', 'name', 'email')->get();
    }

    public function findById(int $id): ?User
    {
        return $this->model->find($id);
    }

    public function create(array $data): User
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->model->lockForUpdate()->findOrFail($id);
        if (!$user->update($data)) {
            throw new \Exception('Failed to update user');
        }
        return true;
    }

    /**
     * Delete user by ID
     * 
     * @param int $id
     * @return bool
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function delete(int $id): bool
    {
        $user = $this->model->lockForUpdate()->findOrFail($id);
        if (!$user->delete()) { // Tái hiện bằng cách dùng ON DELETE RESTRICT trên User table
            throw new \Exception('Failed to delete user');
        }
        return true;
    }

    /**
     * Test database connection
     * 
     * @throws \PDOException
     */
    public function testConnection()
    {
        return $this->model->getConnection()->getPdo();
    }

    /**
     * Test invalid SQL query
     * 
     * @throws \Illuminate\Database\QueryException
     */
    public function testInvalidQuery()
    {
        return $this->model->getConnection()->select('INVALID SQL QUERY');
    }
} 