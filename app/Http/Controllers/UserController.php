<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use App\Http\Request\User\CreateRequest;
use App\Http\Request\User\UpdateRequest;
class UserController extends BaseController
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get List Users
     */
    public function getListUsers(): JsonResponse
    {
        try {
            $result = $this->userService->getListUsers();
            
            return $this->successBase($result, 'Users retrieved successfully');
        } catch (Exception $e) {
            return $this->errorBase('Unexpected error occurred', 500);
        }
    }

    /**
     * int $id
     * Get User By Id
     */
    public function getUserById(int $id): JsonResponse
    {
        try {
            $result = $this->userService->getUserById($id);
            
            return $this->successBase($result, 'Users retrieved successfully');
        } catch (Exception $e) {
            return $this->errorBase('Unexpected error occurred', 500);
        }
    }

    /**
     * Create User
     */
    public function createUser(CreateRequest $request): JsonResponse
    {
        try {
            $params = $request->all();
            $result = $this->userService->createUser($params);
            
            return $this->successBase($result, 'User created successfully');
        } catch (Exception $e) {
            return $this->errorBase('Unexpected error occurred', 500);
        }
    }

    /**
     * Update User
     */
    public function updateUser(UpdateRequest $request, int $id): JsonResponse
    {
        try {
            $params = $request->all();
            $result = $this->userService->updateUser($id, $params);
            
            return $this->successBase($result, 'User updated successfully');
        } catch (Exception $e) {
            return $this->errorBase('Unexpected error occurred', 500);
        }
    }

    /**
     * Delete User
     */
    public function deleteUser(int $id): JsonResponse
    {
        try {
            $result = $this->userService->deleteUser($id);
            return $this->successBase($result, 'User deleted successfully');
        } catch (Exception $e) {
            return $this->errorBase('Unexpected error occurred', 500);
        }
    }
}
