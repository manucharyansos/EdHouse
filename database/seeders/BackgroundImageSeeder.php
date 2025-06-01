<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackgroundImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('background_images')->insert([
            [
                'image_url' => '/storage/images/header-bg-parallax-01-1922x1030.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
