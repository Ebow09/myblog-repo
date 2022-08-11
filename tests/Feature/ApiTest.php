<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_api_returns_all_data()
    {
        $response = $this->get('api/posts'); 
        $response->assertStatus(200);
    }

    public function test_one_post_is_returned(){
        $response= $this->get('api/posts/29', []);
        $response->assertStatus(200);
    }
   public function test_if_unauthenticated_user_can_create_post(){
        $faker = \Faker\Factory::create();

        $response= $this->post('api/create', [
            'title' => $faker->sentence(49),
            'content' => $faker->paragraph,

        ]);
        $response->assertStatus(302);   //redirected to login
   }
   
   public function test_authenticated_user_can_create_post(){    

        $faker = \Faker\Factory::create();
        $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
            ]);
        
        $response= $this->actingAs($user)->post('api/create', [
            'title' => $faker->text(49),
            'content' => $faker->paragraph,
            'user_id' => $faker->randomDigit(),  
        ]);
        $response->assertStatus(201);           
    }

    public function test_authenticated_user_can_update_post(){    

        $faker = \Faker\Factory::create();
        $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
            ]);
        $post = Post::create([
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
        ]);

        $id = $post['id'];
        $response= $this->actingAs($user)->put('api/edit/'.$id, [
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
            'user_id' => $faker->randomDigit(),            
        ]);
        $response->assertStatus(200);           
    }

    public function test_no_post_id_for_update_post(){    

        $faker = \Faker\Factory::create();
        $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
            ]);
        $post = Post::create([
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
        ]);

       $id = null;
       $response= $this->actingAs($user)->put('api/edit/'.$id, [
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
            'user_id' => $faker->randomDigit(),            
        ]);
        $response->assertStatus(404);   
    }

    public function test_authenticated_user_can_delete_post(){           
         $faker = \Faker\Factory::create();
       
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ]);
        $userid =intval($user['id']);
     
        $post = Post::create([
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
            'user_id' => $userid,            
        ]);

        $id =intval($post['id']);

        $response = $this->actingAs($user)->delete('api/remove/'.$id, [
        ]) ->assertStatus(204); 

       
        
        $this->assertEquals(204, $response->getStatusCode());        
      


    }
    
}
