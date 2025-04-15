<?php

namespace App\Enum;

enum CacheKeysEnum: string
{
    case LIST_USER = 'list_user';
    case LIST_POST = 'list_post';
    case POST_BY_ID = 'post_by_id:%s'; // postId
    case USER_BY_ID = 'user_by_id:%s'; // userId
}

