<?php

use App\Library\Common;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

if (!function_exists('isEmailFormat')) {
    function isEmailFormat(string $email): bool
    {
        return preg_match('/^[\w\.\-]+@[\w\-]+\.[a-z]+$/i', $email) === 1;
    }
}

if (!function_exists('isLikeFormat')) {
    function isLikeFormat(string $pattern, string $name): bool
    {
        return preg_match($pattern, $name) === 1;
    }
}

