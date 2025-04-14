<?php

namespace App\Http\Controllers;

use App\Services\LimixPostService;
use App\Services\LimixUserService;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Exception;

class BaseController extends Controller
{
    public function __construct()
    {
    }

    public function responseBase($data, string $message, int $code): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code
        ]);
    }

    public function successBase($data, $message): JsonResponse
    {
        return $this->responseBase($data, $message, 200);
    }

    public function errorBase(string $message, int $code = 500): JsonResponse   
    {
        return $this->responseBase([], $message, $code);
    }

    public function notFoundBase(string $message): JsonResponse
    {
        return $this->responseBase([], $message, 404);
    }
    
    

}
