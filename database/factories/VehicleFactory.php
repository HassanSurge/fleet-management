<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Make;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $makeId = Make::inRandomOrder()->first()['id'];
        $categoryId = Category::inRandomOrder()->first()['id'];

        return [
            'daily_rate' => fake()->randomDigit(),
            'model' => fake()->name(),
            'make_id' => $makeId,
            'category_id' => $categoryId,
        ];
    }
}
