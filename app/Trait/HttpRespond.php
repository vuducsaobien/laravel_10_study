<?php

namespace App\Trait;

use Illuminate\Http\JsonResponse;
use App\Enum\HttpCodeEnum;

trait HttpRespond
{
    /**
     * Return success response
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function successBase(array $data, int $code = HttpCodeEnum::SUCCESS_CODE): JsonResponse
    {
        return response()->json([
            'isSuccess' => $data['isSuccess'],
            'message' => $data['message'],
            'data' => $data['data']
        ], $code);
    }

    /**
     * Return error response
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function errorBase(string $message, int $code = HttpCodeEnum::ERROR_CODE_SYSTEM): JsonResponse
    {
        return response()->json([
            'isSuccess' => false,
            'message' => $message,
            'data' => []
        ], $code);
    }

}
