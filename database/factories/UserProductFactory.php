<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProduct;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table1>
 */
class UserProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::all()->random();
        $product = Product::all()->random();
        $quantity = $this->faker->numberBetween(1, 5);

        return [
            'quantity' => $quantity,
            'total_price' => $quantity * $product->price,
            'user_id' => $user->id,
            'product_id' => $product->id
        ];
    }

    // public function configure(): static
    // {
        // return $this->afterCreating(function (UserProduct $userProduct) {
        //     $userProduct->update([
        //         'total_price' => $userProduct->quantity * $userProduct->product_id + $product->price,
        //     ]);
        // });
    // }

}
