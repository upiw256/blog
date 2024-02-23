<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => $this->faker->name(40),
        'category' => 'academic',
        'description' => $this->faker->realText(500),
        'level' => "Provinsi",
        'champion_to' => "satu",
        'img'=>$this->faker->imageUrl(),
        'year'=>$this->faker->year()
        ];
    }
}
