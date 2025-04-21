<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;
use Throwable;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\DB;
use App\Exceptions\BusinessException;

class UserService
{
    const PER_PAGE = 10;

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get List Users
     */
    // public function getListUsers(): array
    public function getListUsers()
    {
        $key = CacheHelper::generateKey(CacheKeysEnum::USER_LIST);
        $result = CacheHelper::getFromCacheOrSet($key, function () {
            // Cache key not found, get from DB
            
            return $this->userRepository->getAll()->toArray() ?? []; // $value is Array
            // return $this->userRepository->getAll() ?? returnEmptyObject(); // $value is Object
        });

        return $result;
    }

    public function getUserById(int $id)
    {
        $key = CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $id);
        $result = CacheHelper::getFromCacheOrSet($key, function () use ($id) {
            $user = $this->userRepository->findById($id);
            return $user ? $user->toArray() : [];
        });

        return $result;
    }

    public function createUser(array $data)
    {
        $user = $this->userRepository->create($data);
        return $user;
    }

    /**
     * Update user and return result
     *
     * @param int $id
     * @param array $params
     * @return array{isSuccess: bool, data: array, message: string}
     * @throws \App\Exceptions\BusinessException
     */
    public function updateUser(int $id, array $params): array
    {
        $isSuccess = false;
        $data = [];
        $message = 'Update user successfully';

        DB::beginTransaction();
        try {
            $isSuccess = $this->userRepository->update($id, $params);
            $data = $this->getUserById($id);

            DB::commit();
            return compact('isSuccess', 'data', 'message');

        } catch (\Exception $e) {
            DB::rollBack();
            throw new BusinessException($e->getMessage(), $e->getCode() ?: 500);
        }
    }

    /**
     * Delete user and return result
     *
     * @param int $id
     * @return array{isSuccess: bool, data: array, message: string}
     * @throws \App\Exceptions\BusinessException
     */
    public function deleteUser(int $id): array
    {
        $isSuccess = false;
        $data = [];
        $message = 'Delete user successfully';

        DB::beginTransaction();
        try {
            // Get user info before deletion for response
            $user = $this->userRepository->findById($id);
            if (!$user) {
                throw new BusinessException('User not found', 404);
            }

            // Delete user
            $isSuccess = $this->userRepository->delete($id);
            $data = $user->toArray();

            DB::commit();
            return compact('isSuccess', 'data', 'message');
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw new BusinessException($e->getMessage(), $e->getCode() ?: 500);
        }
    }

    /**
     * Test database connection error
     * 
     * @throws PDOException
     */
    public function testDatabaseConnection()
    {
        return $this->userRepository->testConnection();
    }

    /**
     * Test invalid SQL query
     * 
     * @throws QueryException
     */
    public function testInvalidQuery()
    {
        return $this->userRepository->testInvalidQuery();
    }

    /**
     * Test invalid value error
     * 
     * @throws \ValueError
     */
    public function testInvalidValue()
    {
        // This will throw ValueError in PHP 8.0+
        $value = -1;
        if ($value < 0) {
            throw new \ValueError('Value must be non-negative');
        }
    }

    /**
     * Test ParseError
     * 
     * @throws \ParseError
     */
    public function testParseError()
    {
        // This will cause a parse error
        eval('function() {');
    }

    /**
     * Test ArithmeticError
     * 
     * @throws \ArithmeticError
     */
    public function testArithmeticError()
    {
        // This will cause an arithmetic error
        $result = PHP_INT_MAX + 1;
    }

    /**
     * Test CompileError
     * 
     * @throws \CompileError
     */
    public function testCompileError()
    {
        // This will cause a compile error
        eval('class {');
    }

    /**
     * Test DivisionByZeroError
     * 
     * @throws \DivisionByZeroError
     */
    public function testDivisionByZeroError()
    {
        // This will cause a division by zero error
        $result = 5 / 0;
    }

    /**
     * Test UnhandledMatchError
     * 
     * @throws \UnhandledMatchError
     */
    public function testUnhandledMatchError()
    {
        // This will cause an unhandled match error
        $value = 'invalid';
        match($value) {
            'valid' => true,
            'correct' => true,
        };
    }
}
