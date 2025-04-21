<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Enum\HttpCodeEnum;
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
    // protected function successBase($data, string $message, int $code = 200): JsonResponse
    protected function successBase(array $data, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => $data['isSuccess'],
            'data' => $data['data'],
            'message' => $data['message']
        ], $code);
    }

    /**
     * Return error response
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function errorBase(string $message, int $code = HttpCodeEnum::ERROR_CODE_SYSTEM): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }
} 