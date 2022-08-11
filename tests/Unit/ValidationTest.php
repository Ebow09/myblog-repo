<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;


class ValidationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_title_validation_for_creating_new_post()
    {
        $faker = \Faker\Factory::create();   
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ]);

       // $this->actingAs(User::factory()->user()->create());
       $targetFile ="pic.jpg";          
        $response= $this->actingAs($user)->post('/store', [
            'title' => null,
            'content' => $faker->paragraph,
            'imagename' =>$targetFile ,
        ])->assertSessionHasErrors('title');    
    }

    public function test_content_validation_for_creating_new_post()
    {
        $faker = \Faker\Factory::create();   
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ]);

       // $this->actingAs(User::factory()->user()->create());
       $targetFile ="pic.jpg";          
        $response= $this->actingAs($user)->post('/store', [
            'title' => $faker->text(49),
            'content' => null,
            'imagename' =>$targetFile ,
        ])->assertSessionHasErrors('content');    
    }

    public function test_title_validation_for_update_post(){   
        $faker = \Faker\Factory::create();   
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ]);

        $response= $this->actingAs($user)->post('/update', [
            'title' => null,
            'content' => $faker->paragraph,
        ])->assertSessionHasErrors('title');     
    }
    public function test_content_validation_for_update_post(){   
        $faker = \Faker\Factory::create();   
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ]);

        $response= $this->actingAs($user)->post('/update', [
            'title' => $faker->text(49),
            'description' => null,
        ])->assertSessionHasErrors('description');     
    }
}
