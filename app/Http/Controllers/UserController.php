<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Exceptions\Handler;
use Illuminate\Http\JsonResponse;
use Throwable;
use App\Http\Request\User\CreateRequest;
use App\Http\Request\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('users.index', compact('users'));
    }

    public function store(UserRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);
            
            $user = User::create($validated);
            
            if (!$user) {
                return back()->with('error', 'Failed to create user. Please try again.');
            }

            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while creating the user: ' . $e->getMessage());
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $validated = $request->validated();

            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            Log::error('User update failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the user: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            if ($id == auth()->id()) {
                return back()->with('error', 'Bạn không thể xóa chính mình.');
            }

            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('User deletion failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting the user: ' . $e->getMessage());
        }
    }

    /**
     * Get List Users
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
     * int $id
     * Get User By Id
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