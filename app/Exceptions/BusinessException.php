<?php

namespace App\Exceptions;

use Exception;
use App\Enum\HttpCodeEnum;
class BusinessException extends Exception
{
    public function __construct(string $message = "", ?\Throwable $previous = null)
    {
        parent::__construct($message, HttpCodeEnum::ERROR_CODE_BUSSINESS, $previous);
    }
} 