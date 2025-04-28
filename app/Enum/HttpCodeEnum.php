<?php

namespace App\Enum;

enum HttpCodeEnum: int
{
    const SUCCESS_CODE = 200;

    const ERROR_CODE_VALIDATION = 422;
    const ERROR_CODE_DATABASE = 423;
    const ERROR_CODE_BUSSINESS = 424;
    
    const ERROR_CODE_SYSTEM = 450;
}

