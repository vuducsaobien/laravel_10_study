<?php

namespace App\Enum;

enum CacheKeysEnum: string
{
    // User
    case USER_LIST = 'user:list';
    case USER_BY_ID = 'user:%s'; // userId

    // Post
    case POST_LIST = 'post:list';
    case POST_BY_ID = 'post:%s'; // postId
}

