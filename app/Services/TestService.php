<?php

namespace App\Services;

use App\Repositories\TestRepository;
use App\Enum\DatabaseExceptionTypesEnum;
use App\Exceptions\BusinessException;
use Illuminate\Support\Facades\DB;
use Throwable;

class TestService
{
    private $repository;

    public function __construct(TestRepository $testRepository)
    {
        $this->repository = $testRepository;
    }

    /**
     * Get List
     */
    public function getList()
    {
        return $this->repository->getAll()->toArray() ?? []; // $value is Array
    }

    public function testDatabaseException(string $type)
    {
        switch ($type) {
            case DatabaseExceptionTypesEnum::CONNECTION:
                return $this->repository->testConnection();

            case DatabaseExceptionTypesEnum::QUERY:
                return $this->repository->testInvalidQuery();
            default:
                throw new \Exception('Invalid test type');
        }
    } 
    
    public function testBussinessException()
    {
        DB::beginTransaction();
        try {
            // Update record để test rollback DB
            $id = 1;
            $this->repository->update($id, ['name' => 'Test Rollback DB']);

            // Test record not found - BusinessException
            $idNotExist = -99999;
            $testRecordNotFound = $this->repository->findById($idNotExist);
            if (!$testRecordNotFound) {
                throw new BusinessException('BusinessException - Test record not found');
            }

            // Test division by zero - SystemException
            // $divisionByZero = 5 / 0;
            
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
