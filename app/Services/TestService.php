<?php

namespace App\Services;

use App\Repositories\TestRepository;
use App\Enum\DatabaseExceptionTypesEnum;
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
        $idNotExist = -99999;
        $testRecordNotFound = $this->repository->findById($idNotExist);
        if (!$testRecordNotFound) {
            throw new \App\Exceptions\BusinessException('BusinessException - Test record not found');
        }
    }

}
