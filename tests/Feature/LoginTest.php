<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }
    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $faker = \Faker\Factory::create();
        $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
            ]);

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/');
    }
}
