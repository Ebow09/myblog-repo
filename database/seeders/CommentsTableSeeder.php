<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use Carbon\Carbon;

class commentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        comment::truncate();

       
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            comment::create([
                'title' => $faker->sentence,
                'comment' => $faker->paragraph,
                'postId' => $faker->numberBetween(1, 100),
                'publishedAt' => date("Y-m-d H:i:s") 
            ]);

         }
    }
}
