<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * Return success response
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successBase($data, string $message, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $code);
    }

    /**
     * Return error response
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function errorBase(string $message, int $code = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }

    /**
     * Default catch logic
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function getCatchLogic(string $message): JsonResponse
    {
        return $this->errorBase(__('message.user.unexpected_error_occurred', ['message' => $message]));
    }
} 