<?php

namespace Database\Factories;

use App\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_name' => $this->faker->title,
            'item_description' => $this->faker->text,
            'price' => $this->faker->numberBetween(30000,15000000),
            'unit' => $this->faker->numberBetween(0,100),
            'image' => $this->faker->imageUrl()
        ];
    }
}
