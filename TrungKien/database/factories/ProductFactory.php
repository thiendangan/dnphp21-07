<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Str::random(5),
            'product_name' => $this->faker->sentence(3),
            'product_price' =>$this->faker->numberBetween(1000, 100000),
            'product_image' => '1626158936LIuU.jpg',
            'product_description' =>$this->faker->sentence(5),
            'product_category_id' => Category::inRandomOrder()->first()->product_category_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
