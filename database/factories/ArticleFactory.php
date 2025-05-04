<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

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
        return [
            'title' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->sentence),
            'content' => $this->faker->paragraphs(3, true),
            'image' => 'https://picsum.photos/id/' . rand(100, 150) . '/200/300', // Generate a random image ID between 100 and 150
            'user_id' => User::inRandomOrder()->first()->id ?? 1, // Ambil user_id secara acak atau default ke 1
            'is_published' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
