<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Exceptions\Handler;
use Illuminate\Http\JsonResponse;
use Throwable;
use App\Http\Request\User\CreateRequest;
use App\Http\Request\User\UpdateRequest;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Blog Post API Documentation",
 *     description="API documentation for Blog Post application",
 *     @OA\Contact(
 *         email="admin@example.com"
 *     )
 * )
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Local Development Server"
 * )
 * @OA\Server(
 *     url=NGROK_URL,
 *     description="Ngrok Tunnel Server"
 * )
 */
class UserController extends BaseController
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
    * @OA\Get(
    *     path="/api/users",
    *     tags={"User"},
    *     summary="Get List Users",
    *     security={{"apiKey":{}}},
    *     @OA\Response(response=200, description="Success"),
    *     @OA\Response(response=401, description="Unauthenticated")
    * )
    */
    public function getListUsers(): JsonResponse
    {
        try {
            $result = $this->userService->getListUsers();
            return $this->successBase($result, __('message.user.retrieved_successfully'));
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"User"},
     *     summary="Get User By Id",
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, description="User ID"),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function getUserById(int $id): JsonResponse
    {
        try {
            $result = $this->userService->getUserById($id);
            return $this->successBase($result, __('message.user.retrieved_successfully'));
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
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
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
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
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
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
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }

    /**
     * Test different types of exceptions
     * 
     * @param string $type Type of exception to test
     * @return JsonResponse
     */
    public function testExceptions(string $type): JsonResponse
    {
        try {
            switch ($type) {
                case 'type':
                    // TypeError: Passing string to function expecting int
                    $this->userService->getUserById('not_an_integer');
                    break;
                case 'argument':
                    // ArgumentCountError: Missing required parameter
                    // Using a function that requires multiple parameters
                    $this->userService->updateUser(1, []); // Fixed: Added required parameters
                    break;
                case 'pdo':
                    // PDOException: Database connection error
                    $this->userService->testDatabaseConnection();
                    break;
                case 'query':
                    // QueryException: Invalid SQL query
                    $this->userService->testInvalidQuery();
                    break;
                case 'value':
                    // ValueError: Invalid value
                    $this->userService->testInvalidValue();
                    break;
                case 'parse':
                    // ParseError: Invalid PHP syntax
                    $this->userService->testParseError();
                    break;
                case 'compile':
                    // CompileError: Invalid class definition
                    $this->userService->testCompileError();
                    break;
                case 'division':
                    // DivisionByZeroError: Division by zero
                    $this->userService->testDivisionByZeroError();
                    break;
                case 'unhandled':
                    // UnhandledMatchError: No matching case in match expression
                    $this->userService->testUnhandledMatchError();
                    break;
                default:
                    return $this->errorBase('Invalid test type', 400);
            }
            return $this->successBase(null, 'Test completed successfully');
        } catch (Throwable $e) {
            return (new Handler(app()))->render(request(), $e);
        }
    }
}