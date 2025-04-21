<?php

namespace App\Exceptions;

use Exception;
use App\Enum\HttpCodeEnum;
class DatabaseException extends Exception
{
    public function __construct(string $message = "", ?int $code = null, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code ?? HttpCodeEnum::ERROR_CODE_DATABASE, $previous);
    }
} 