<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * Test Get Index
     *
     * @return void
     */
    public function testGetIndex()
    {
        $response = $this->get('/users');

        $response->assertStatus(200)
            ->assertViewIs('users.index');
    }

    /**
     * Test Get Index
     *
     * @return void
     */
    public function testGetShow()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get('/users/1');

        $response->assertStatus(200)
            ->assertViewis('users.show');
    }
}
