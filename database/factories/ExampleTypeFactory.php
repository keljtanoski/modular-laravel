<?php

namespace Database\Factories;

use App\Modules\ExampleType\Models\ExampleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ExampleType>
 */
class ExampleTypeFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = ExampleType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'is_active' => $this->faker->boolean(70),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
