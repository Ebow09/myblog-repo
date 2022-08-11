<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;

class DeletePostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_a_post()
    {
        $faker = \Faker\Factory::create();
        $post = Post::create([
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
        ]);
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ]);

        $response = $this->actingAs($user)->post('/delete/'.$post->id, [
        ]);
        
        $this->assertEquals(302, $response->getStatusCode());        
        
    }
    public function test_delete_a_post_wrong_id(){
        $faker = \Faker\Factory::create();    
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ]); 
        $id = 399999;
        //post with id 3999999 is not available
        $response = $this->actingAs($user)->post('/delete/'.$id, [
        ]);
        
        $this->assertEquals(404, $response->getStatusCode());    
    }
    public function test_delete_a_post_no_id(){
        $faker = \Faker\Factory::create();
        $user = Post::create([
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
        ]);
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ]);
        //post with id 3999999 is not available
        $response = $this->actingAs($user)->post('/delete/39999', []);
        $this->assertEquals(404, $response->getStatusCode());    
    }
 
}
