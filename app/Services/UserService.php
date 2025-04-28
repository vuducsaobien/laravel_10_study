<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Helpers\CacheHelper;
use App\Enum\CacheKeysEnum;
use Throwable;
use Illuminate\Support\Facades\DB;

class UserService extends BaseService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get List Users
     */
    public function getListUsers()
    {
        $isSuccess = false;
        $data = [];
        $message = 'Get list users successfully';

        try {
            $key = CacheHelper::generateKey(CacheKeysEnum::USER_LIST);
            $data = CacheHelper::getFromCacheOrSet($key, function () {
                // Cache key not found, get from DB
                return CacheHelper::returnCachedResult(
                    $this->userRepository->getAll()
                    // $this->userRepository->getAllWithPosts()
                );
            });

            $isSuccess = true;
    
            return compact('isSuccess', 'data', 'message');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getUserById(int $id): array
    {
        $isSuccess = false;
        $data = [];
        $message = '';

        try {
            $data = $this->getUserByIdViaCache($id);
            $isSuccess = true;
            $message = __('message.user.retrieved_successfully');

            return compact('isSuccess', 'data', 'message');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Create user and return result
     *
     * @param array $data
     * @return array{isSuccess: bool, data: array, message: string}
     * @throws \Throwable
     */
    public function createUser(array $data): array
    {
        $isSuccess = false;
        $data = [];
        $message = '';

        try {
            $data = $this->userRepository->create($data);
            $isSuccess = true;
            $message = __('message.user.created_successfully');

            return compact('isSuccess', 'data', 'message');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update user and return result
     *
     * @param int $id
     * @param array $params
     * @return array{isSuccess: bool, data: array, message: string}
     * @throws \Throwable
     */
    public function updateUser(int $id, array $params): array
    {
        $isSuccess = false;
        $data = [];
        $message = '';

        DB::beginTransaction();
        try {
            $isSuccess = $this->userRepository->updateWithLock($id, $params);
            $data = $this->getUserByIdViaCache($id);
            
            DB::commit();
            return compact('isSuccess', 'data', 'message');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Delete user and return result
     *
     * @param int $id
     * @return array{isSuccess: bool, data: array, message: string}
     * @throws \Throwable
     */
    public function deleteUser(int $id): array
    {
        $isSuccess = false;
        $data = [];
        $message = '';

        DB::beginTransaction();
        try {
            $isSuccess = $this->userRepository->delete($id);
            $message = __('message.user.deleted_successfully');

            DB::commit();
            return compact('isSuccess', 'data', 'message');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function getUserByIdViaCache(int $id)
    {
        $data = CacheHelper::returnCachedEmptyInit();
        try {
            $key = CacheHelper::generateKey(CacheKeysEnum::USER_BY_ID, $id);
            $data = CacheHelper::getFromCacheOrSet($key, function () use ($id) {
                return CacheHelper::returnCachedResult(
                    $this->userRepository->findById($id)
                );
            });

            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
