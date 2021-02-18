<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    /**
     * Admin Index Test.
     *
     * @return void
     */
    /* public function testExample()
    {
        $user = factory(User::class)->create([
            'role' => '管理者'
        ]);
        $response = $this
            ->actingAs($user)
            ->get('/admin/index');

        $response->assertStatus(200)
            ->assertViewIs('admin.index');
    } */
}
