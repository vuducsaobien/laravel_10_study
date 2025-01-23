<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(4)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        // ]);

        if (DB::table('users')->count() > 0) {

            $tablesPhuThuoc = ['fingers', 'phones'];

            // Tắt kiểm tra khóa ngoại
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Xóa dữ liệu trong các bảng phụ thuộc (nếu có)
            foreach ($tablesPhuThuoc as $table) {
                DB::table($table)->delete();
            }

            // Xóa dữ liệu trong bảng 'users'
            User::query()->delete();

            // Reset ID về 1
            DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');
            foreach ($tablesPhuThuoc as $table) {
                // DB::table($table)->delete();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
            }

            // Bật lại kiểm tra khóa ngoại
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        User::factory(4)->create();
    }
}
