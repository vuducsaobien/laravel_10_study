<?php

return [
    'user' => [
        'retrieved_successfully' => 'User retrieved successfully',
        'unexpected_error_occurred' => 'Unexpected error occurred: :message',
    ],
    'post' => [
        'retrieved_successfully' => 'Post retrieved successfully',
        'unexpected_error_occurred' => 'Unexpected error occurred: :message',
    ],
    'error' => [
        'type_error_occurred' => '2 - Type error occurred: :message',
        'argument_count_error_occurred' => '3 - Argument count error occurred: :message',
        'database_connection_error_occurred' => '4 - Database connection error occurred: :message',
        'database_query_error_occurred' => '5 - Database query error occurred: :message',
        
        'value_error_occurred' => '6 - Value error occurred: :message',
        'parse_error_occurred' => '7 - Parse error occurred: :message',
        'arithmetic_error_occurred' => '8 - Arithmetic error occurred: :message',
        'compile_error_occurred' => '9 - Compile error occurred: :message',
        'division_by_zero_error_occurred' => '10 - Division by zero error occurred: :message',
        'unhandled_match_error_occurred' => '11 - Unhandled match error occurred: :message',
    ],

    // case $e instanceof ValueError:
    //     return $this->errorBase(__('message.error.value_error_occurred', ['message' => $e->getMessage()]), 500);
    // case $e instanceof ParseError:
    //     return $this->errorBase(__('message.error.parse_error_occurred', ['message' => $e->getMessage()]), 500);
    // case $e instanceof ArithmeticError:
    //     return $this->errorBase(__('message.error.arithmetic_error_occurred', ['message' => $e->getMessage()]), 500);
    // case $e instanceof CompileError:
    //     return $this->errorBase(__('message.error.compile_error_occurred', ['message' => $e->getMessage()]), 500);
    // case $e instanceof DivisionByZeroError:
    //     return $this->errorBase(__('message.error.division_by_zero_error_occurred', ['message' => $e->getMessage()]), 500);
    // case $e instanceof UnhandledMatchError:
    //     return $this->errorBase(__('message.error.unhandled_match_error_occurred', ['message' => $e->getMessage()]), 500);

];
