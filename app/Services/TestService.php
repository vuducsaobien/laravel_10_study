<?php

namespace App\Services;

use App\Repositories\TestRepository;
use App\Enum\DatabaseExceptionTypesEnum;
use App\Exceptions\BusinessException;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;
use App\Repositories\UserRepository;
use App\Enum\CacheDataTypeEnum;
class TestService
{
    private $repository;
    private $userRepository;

    public function __construct(TestRepository $testRepository, UserRepository $userRepository)
    {
        $this->repository = $testRepository;
        $this->userRepository = $userRepository;
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

    public function testCacheArrayOrObject()
    {
        $isSuccess = false;
        $data = [];
        $message = '';

        try {
            $id = 3;
            $key = CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $id);
            $data = CacheHelper::getFromCacheOrSet($key, function () use ($id) {
                return CacheHelper::returnCachedResult(
                    $this->userRepository->findById($id), 
                    CacheDataTypeEnum::ARRAY
                    // CacheDataTypeEnum::OBJECT
                );
            });

            $message = __('message.user.retrieved_successfully');

            echo '<pre style="color:red";>$data === '; print_r($data);echo '</pre>';

            $dataObject = $data->posts[0]->title;
            var_dump($dataObject);
            die('testCacheArrayOrObject');

            return compact('isSuccess', 'data', 'message');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
