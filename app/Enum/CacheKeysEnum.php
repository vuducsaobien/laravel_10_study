<?php

namespace App\Enum;

enum CacheKeysEnum: string
{
    case USER_INFO = 'user_infor:%s:%s'; // userId + username
    case PRODUCT_BY_ID = 'product_by_id:%s'; // productId
    case LIST_PAGE_PRODUCTS = 'list_products_page:%s'; // page number, page 1, page 2
    case SINGLE_KEY = '%s';
}

