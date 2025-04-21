<?php

namespace App\Enum;

enum DatabaseExceptionTypesEnum: string
{
    const CONNECTION = 'connection';
    const QUERY = 'query';

    public static function getValues(): array
    {
        return [
            self::CONNECTION,
            self::QUERY,
        ];
    }
}

