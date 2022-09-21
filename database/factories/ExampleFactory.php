<?php

namespace Database\Factories;

use App\Modules\Example\Models\Example;
use App\Modules\ExampleType\Models\ExampleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Example>
 */
class ExampleFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Example::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->optional(0.7)->text(),
            'example_type_id' => ExampleType::inRandomOrder()->first()->id,
            'is_active' => $this->faker->boolean(70),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
