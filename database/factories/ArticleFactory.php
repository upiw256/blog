<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $this->faker = Faker\Factory::create('id_ID');
        
        return [
        'title' => $this->faker->realText(40),
        'slug' => $this->faker->unique()->slug,
        'content' => $this->faker->realText(500),
        'image' => $this->faker->imageUrl(256, 256),
        // 'user_id' => factory(App\Models\User::class)->create()->id,
        'is_published' => true,
        ];
    }
}
