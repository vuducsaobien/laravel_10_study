<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * Test database connection
     * 
     * @throws \PDOException
     */
    public function testConnection()
    {
        DB::connection()->getPdo();
    }

    /**
     * Test invalid SQL query
     * 
     * @throws \Illuminate\Database\QueryException
     */
    public function testInvalidQuery()
    {
        DB::select('SELECT * FROM non_existent_table');
    }
} 