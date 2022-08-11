<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
  
   public function test_authenticated_user_can_post(){   
        $faker = \Faker\Factory::create();   
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ]);

       // $this->actingAs(User::factory()->user()->create());
       $targetFile ="pic.jpg";          
        $response= $this->actingAs($user)->post('/store', [
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
            'imagename' =>$targetFile ,
        ]);
        $response->assertStatus(302);   
    }
    public function test_if_unauthenticated_user_can_post(){

        $faker = \Faker\Factory::create();   
    
        
        $response= $this->post('/store', [
            'title' => $faker->text(49),
            'content' => $faker->paragraph,

        ]);
        $response->assertRedirect('/login');  
   }
}
