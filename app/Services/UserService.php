<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Repositories\UserRepository;
use PDOException;
use Illuminate\Database\QueryException;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;

class UserService
{
    const PER_PAGE = 10;

    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get List Users
     */
    public function getListUsers()
    {
        $key = CacheHelper::generateKey(CacheKeysEnum::LIST_USER);
        $result = User::getFromCacheOrSet($key, function () {
            return (new User())->getListUsers()->toArray();
        });

        return $result;
    }

    public function getUserById(int $id)
    {
        $key = CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $id);
        $result = User::getFromCacheOrSet($key, function () use ($id) {
            return User::getUserById($id)->toArray();
        });

        return $result;
    }

    public function createUser(array $data)
    {
        return User::createUser($data);
    }

    public function updateUser(int $id, array $params): User
    {
        $user = User::findOrFail($id);
        $user->update($params);
        return $user;
    }

    public function deleteUser(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }

    /**
     * Test database connection error
     * 
     * @throws PDOException
     */
    public function testDatabaseConnection()
    {
        // Try to connect to a non-existent database
        config(['database.connections.mysql.database' => 'non_existent_database']);
        $this->userRepository->testConnection();
    }

    /**
     * Test invalid SQL query
     * 
     * @throws QueryException
     */
    public function testInvalidQuery()
    {
        // Execute an invalid SQL query
        $this->userRepository->testInvalidQuery();
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
