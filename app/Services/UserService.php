<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use PDOException;
use Illuminate\Database\QueryException;

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
    public function getListUsers(): Collection
    {
        // return User::getListUsersPaginate(self::PER_PAGE);
        return User::getListUsers();
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
