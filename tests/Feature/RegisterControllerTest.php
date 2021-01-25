<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetRegister()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->get('/register');

        $response->assertStatus(200);
    }
}
