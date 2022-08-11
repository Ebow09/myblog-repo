<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CreateCommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_guest_can_post_comment(){   
       
        $faker = \Faker\Factory::create();
        $post = Post::create([
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
        ]);
      
        $response= $this->post('/savecomment', [
            'title' => $faker->sentence,
            'comment' => $faker->paragraph,
            'postId' => 1,
        ]);
        
        $response->assertStatus(302);   
    }

    public function test_no_comment_validation_error(){
        $faker = \Faker\Factory::create();
        $post = Post::create([
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
        ]);
        
        $response= $this->post('/savecomment', [
            'title' => $faker->sentence,
            'comment' => null,
            'postId' => 1,
        ]);        
        $response->assertSessionHasErrors(['comment']);
    }
   
}
