<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TestUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TestUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (TestUser $table) {
            // ...
        })->afterCreating(function (TestUser $table) {
            // $table->update([
            //     'name' => "table User - id : {$table->id}" // Chú ý: Sau khi tạo User qua Factory, name sẽ đổi lại
            // ]);
        });
    }

}
