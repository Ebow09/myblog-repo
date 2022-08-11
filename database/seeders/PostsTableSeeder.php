<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Let's truncate our existing records to start from scratch.
         post::truncate();

         $faker = \Faker\Factory::create();
 
         // And now, let's create a few articles in our database:
         for ($i = 0; $i < 50; $i++) {
             post::create([
                 'title' => $faker->sentence,
                 'content' => $faker->paragraph,
                 'user_id' => $faker->numberBetween(0, 10),
             ]);
         }
    }
}
