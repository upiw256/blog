<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // Ambil pengguna pertama sebagai default

        if ($user) {
            Article::factory(20)->create([
                'user_id' => $user->id, // Tetapkan user_id
            ]);
        } else {
            $this->command->error('No users found. Please create a user first.');
        }
    }
}
