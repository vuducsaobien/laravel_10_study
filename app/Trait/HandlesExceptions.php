<?php

namespace App\Trait;

use Throwable;
use App\Enum\HttpCodeEnum;

// 1. Validation errors
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;

// 2. Database errors
// 2.1 PDO errors
use PDOException;

// 2.2 Eloquent errors (Illuminate\Database\Eloquent\)
use Illuminate\Database\Eloquent\InvalidCastException as EloquentInvalidCastException;
use Illuminate\Database\Eloquent\JsonEncodingException as EloquentJsonEncodingException;
use Illuminate\Database\Eloquent\MassAssignmentException as EloquentMassAssignmentException;
use Illuminate\Database\Eloquent\MissingAttributeException as EloquentMissingAttributeException;
use Illuminate\Database\Eloquent\ModelNotFoundException as EloquentModelNotFoundException;
use Illuminate\Database\Eloquent\PendingHasThroughRelationship as EloquentPendingHasThroughRelationship;
use Illuminate\Database\Eloquent\RelationNotFoundException as EloquentRelationNotFoundException;

// 2.3 Database errors (Illuminate\Database\)
use Illuminate\Database\ClassMorphViolationException as IlluminateDatabaseClassMorphViolationException;
use Illuminate\Database\DeadlockException as IlluminateDatabaseDeadlockException;
use Illuminate\Database\LazyLoadingViolationException as IlluminateDatabaseLazyLoadingViolationException;
use Illuminate\Database\LostConnectionException as IlluminateDatabaseLostConnectionException;
use Illuminate\Database\MultipleColumnsSelectedException as IlluminateDatabaseMultipleColumnsSelectedException;
use Illuminate\Database\MultipleRecordsFoundException as IlluminateDatabaseMultipleRecordsFoundException;
use Illuminate\Database\QueryException as IlluminateDatabaseQueryException;
use Illuminate\Database\RecordsNotFoundException as IlluminateDatabaseRecordsNotFoundException;
use Illuminate\Database\SQLiteDatabaseDoesNotExistException as IlluminateDatabaseSQLiteDatabaseDoesNotExistException;
use Illuminate\Database\UniqueConstraintViolationException as IlluminateDatabaseUniqueConstraintViolationException;

use App\Exceptions\BusinessException;

trait HandlesExceptions
{
    private $statusCode = 0;

    protected function handleException(Throwable $e): int
    {
        $handlers = [
            '__handleValidationException',
            '__handleDatabaseException',
            '__handleBusinessException',
        ];

        foreach ($handlers as $handler) {
            $statusCode = $this->{$handler}($e);
            if ($statusCode !== 0) {
                return $statusCode;
            }
        }

        return HttpCodeEnum::ERROR_CODE_SYSTEM;
    }

    private function __handleValidationException(Throwable $e): int
    {
        if (
            $e instanceof UnauthorizedException || 
            $e instanceof ValidationException
        ) {
            return HttpCodeEnum::ERROR_CODE_VALIDATION;
        }

        return 0;
    }

    private function __handleDatabaseException(Throwable $e): int
    {
        if (
            $e instanceof PDOException || 

            $e instanceof EloquentInvalidCastException || 
            $e instanceof EloquentJsonEncodingException || 
            $e instanceof EloquentMassAssignmentException || 
            $e instanceof EloquentMissingAttributeException || 
            $e instanceof EloquentModelNotFoundException || 
            $e instanceof EloquentPendingHasThroughRelationship || 
            $e instanceof EloquentRelationNotFoundException ||

            $e instanceof IlluminateDatabaseClassMorphViolationException || 
            $e instanceof IlluminateDatabaseDeadlockException || 
            $e instanceof IlluminateDatabaseLazyLoadingViolationException || 
            $e instanceof IlluminateDatabaseLostConnectionException || 
            $e instanceof IlluminateDatabaseMultipleColumnsSelectedException || 
            $e instanceof IlluminateDatabaseMultipleRecordsFoundException || 
            $e instanceof IlluminateDatabaseQueryException || 
            $e instanceof IlluminateDatabaseRecordsNotFoundException || 
            $e instanceof IlluminateDatabaseSQLiteDatabaseDoesNotExistException || 
            $e instanceof IlluminateDatabaseUniqueConstraintViolationException
        ) {
            return HttpCodeEnum::ERROR_CODE_DATABASE;
        }

        return 0;
    }

    private function __handleBusinessException(Throwable $e): int
    {
        if ($e instanceof BusinessException) {
            return HttpCodeEnum::ERROR_CODE_BUSSINESS;
        }

        return 0;
    }
}
