<?php
use App\Enum\CacheDataTypeEnum;

return [
    // 60 second * 60 minutes * 24 hours * 1 day
    // second : 60 * 60 * 24 * 1
    // 'cache_time_expired' => 86400 // 24 hours or 1 day
    'cache_time_expired' => 3600, // 1 hour

    'cache_data_type' => CacheDataTypeEnum::ARRAY,
    // 'cache_data_type' => CacheDataTypeEnum::OBJECT,
];
