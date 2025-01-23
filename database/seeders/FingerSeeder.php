<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Finger;
use Illuminate\Support\Facades\DB;

class FingerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::all();
        // Tạo dữ liệu Finger cho từng user
        $users->each(function ($user) {
            if ($user->id != 4) {
                Finger::factory()->create([
                    'user_id' => $user->id, // Gán user_id từ User
                ]);    
            }
        });
    }
}
