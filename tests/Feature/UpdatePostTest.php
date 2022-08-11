<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;


class UpdatePostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_authenticated_user_can_update_post(){   
        $faker = \Faker\Factory::create();   
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ]);

        $response= $this->actingAs($user)->post('/update', [
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
        ]);
        $response->assertStatus(302);   
    }

    public function test_if_unauthenticated_user_can_update(){

        $faker = \Faker\Factory::create();          
        $response= $this->post('/update', [
            'title' => $faker->sentence,
            'content' => $faker->paragraph,

        ]);
        $response->assertRedirect('/login');  
   }
 
}
