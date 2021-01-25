<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        
        $this->assertGuest();
    }

    public function testPostLogin()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->get(route('home'));

        $response->assertStatus(200);
        $this->assertAuthenticated();
    }
}
