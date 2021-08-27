<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'image' => $this->faker->image('public/storage/images/',640,480,null,false),
            'category' => $this->faker->text(20),
            'price' => $this->faker->numberBetween(10, 100),
            'quantity' => $this->faker->numberBetween(5, 30)
        ];
    }
}
