<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use TypeError;
use ArgumentCountError;
use PDOException;
use ValueError;
use ParseError;
use ArithmeticError;
use CompileError;
use DivisionByZeroError;
use UnhandledMatchError;
use Illuminate\Database\QueryException;
use Illuminate\Testing\Exceptions\InvalidArgumentException;
use Illuminate\Validation\ValidationException;
use App\Enum\HttpCodeEnum;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Always return JSON for API requests
        if ($request->is('api/*') || $request->expectsJson()) {
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage(),
                    'errors' => $exception->errors(),
                    'code' => HttpCodeEnum::ERROR_CODE_VALIDATION
                ], HttpCodeEnum::ERROR_CODE_VALIDATION);
            }

            $statusCode = $this->getStatusCode($exception);
            
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'code' => $statusCode
            ], $statusCode);
        }

        return parent::render($request, $exception);
    }

    /**
     * Get appropriate status code for exception
     *
     * @param Throwable $e
     * @return int
     */
    private function getStatusCode(Throwable $e): int
    {
        // Database errors
        // if ($e instanceof PDOException || $e instanceof QueryException) {
        //     return 500; // Internal Server Error
        // }

        // Client errors (400 Bad Request)
        // if ($e instanceof \InvalidArgumentException || 
        //     $e instanceof TypeError || 
        //     $e instanceof ArgumentCountError ||
        //     $e instanceof ValueError ||
        //     $e instanceof ArithmeticError ||
        //     $e instanceof DivisionByZeroError ||
        //     $e instanceof UnhandledMatchError) {
        //     return 400; // Bad Request
        // }

        // Parse and Compile errors
        // if ($e instanceof ParseError || $e instanceof CompileError) {
        //     return 500; // Internal Server Error
        // }

        // // Authentication errors
        // if ($e instanceof \Illuminate\Auth\AuthenticationException) {
        //     return 401; // Unauthorized
        // }

        // // Authorization errors
        // if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
        //     return 403; // Forbidden
        // }

        // // Not found errors
        // if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
        //     return 404; // Not Found
        // }

        // Default to 500 if no specific status code is found
        return 500;
    }
}
