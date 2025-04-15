<?php

namespace App\Traits;

use TypeError;
use ArgumentCountError;
use PDOException;
use Illuminate\Database\QueryException;
use Exception;
use Throwable;
use ValueError;
use ParseError;
use ArithmeticError;
use CompileError;
use DivisionByZeroError;
use UnhandledMatchError;

trait HandleException
{
    /**
     * Handle common exceptions and errors
     *
     * @param Throwable $e
     * @return mixed
     */
    protected function handleException(Throwable $e)
    {
        // var_dump($e);die;
        switch (true) {
            case $e instanceof ArgumentCountError:
                return $this->errorBase(__('message.error.argument_count_error_occurred', ['message' => $e->getMessage()]), 500);
            case $e instanceof TypeError:
                return $this->errorBase(__('message.error.type_error_occurred', ['message' => $e->getMessage()]), 500);
            case $e instanceof QueryException:
                return $this->errorBase(__('message.error.database_query_error_occurred', ['message' => $e->getMessage()]), 500);
            case $e instanceof PDOException:
                return $this->errorBase(__('message.error.database_connection_error_occurred', ['message' => $e->getMessage()]), 500);
            
            case $e instanceof ValueError:
                return $this->errorBase(__('message.error.value_error_occurred', ['message' => $e->getMessage()]), 500);
            case $e instanceof ParseError:
                return $this->errorBase(__('message.error.parse_error_occurred', ['message' => $e->getMessage()]), 500);
            case $e instanceof ArithmeticError:
                return $this->errorBase(__('message.error.arithmetic_error_occurred', ['message' => $e->getMessage()]), 500);
            case $e instanceof CompileError:
                return $this->errorBase(__('message.error.compile_error_occurred', ['message' => $e->getMessage()]), 500);
            case $e instanceof DivisionByZeroError:
                return $this->errorBase(__('message.error.division_by_zero_error_occurred', ['message' => $e->getMessage()]), 500);
            case $e instanceof UnhandledMatchError:
                return $this->errorBase(__('message.error.unhandled_match_error_occurred', ['message' => $e->getMessage()]), 500);
                
            // default:
            //     return $this->getCatchLogic($e->getMessage());
        }
    }

    // Error
    // Exception
    // Throwable
    // RequestParseBodyException
} 