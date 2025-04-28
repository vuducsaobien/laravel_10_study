<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use Illuminate\Http\JsonResponse;
use Throwable;
use App\Http\Request\Test\DeleteRequest;
use App\Services\TestService;
use App\Http\Request\Test\DatabaseRequest;
use App\Enum\DatabaseExceptionTypesEnum;
class TestController extends BaseController
{
    private $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function testValidateException(DeleteRequest $request)
    {
        die('PASS - ' . __METHOD__);
    }

    /**
     * Test database errors
     * 
     * @param string $type Type of database error to test
     * @return JsonResponse
     */
    public function testDatabaseException(DatabaseRequest $request): JsonResponse
    {
        try {
            switch ($request->type) {
                case DatabaseExceptionTypesEnum::CONNECTION:
                    // Test database connection error
                    $this->testService->testDatabaseException(DatabaseExceptionTypesEnum::CONNECTION);
                    break;
                case DatabaseExceptionTypesEnum::QUERY:
                    // Test invalid SQL query
                    $this->testService->testDatabaseException(DatabaseExceptionTypesEnum::QUERY);
                    break;
            }
            return $this->successBase([], 'Test completed successfully');
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    public function testBussinessException()
    {
        try {
            $this->testService->testBussinessException();
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    public function testSystemException()
    {
        try {
            $divisionByZero = 5 / 0;
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    public function testCacheArrayOrObject()
    {
        try {
            $this->testService->testCacheArrayOrObject();
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

}