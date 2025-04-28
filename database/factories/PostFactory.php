<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::all()->random();

        return [
            // 'title' => fake()->title(),
            'title' => '',
            'content' => fake()->text(),
            'author_id' => $user->id
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Post $table) {
            // ...
        })->afterCreating(function (Post $table) {
            $table->update([
                'title' => "Post title - id : {$table->id}" // Chú ý: Sau khi tạo Post qua Factory, title sẽ đổi lại
            ]);
        });
    }

}
