<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestUser;

class TestUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        TestUser::factory(10)->create(); // Để chắc chắn có User không có Post nào
    }
}
