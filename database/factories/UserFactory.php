<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => '',
            // 'name' => fake()->name(),
            'email' => fake()->email(),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (User $table) {
            // ...
        })->afterCreating(function (User $table) {
            $table->update([
                'name' => "User name - id : {$table->id}" // Chú ý: Sau khi tạo User qua Factory, name sẽ đổi lại
            ]);
        });
    }

}
