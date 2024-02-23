<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class extracurricular_activities extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\extracurricularactivity::factory()
            // Customize the number of articles here
            ->count(10)
            ->create();
    }
}
