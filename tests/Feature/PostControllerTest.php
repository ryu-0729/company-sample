<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{

    /**
     * Test Get Index.
     *
     * @return void
     */
    public function testGetIndex()
    {
        $response = $this->get('/posts');

        $response->assertStatus(200)
            ->assertViewIs('posts.index');
    }

    /**
     * Test Get Show.
     *
     * @return void
     */
    public function testGetShow()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get('/posts/1');

        $response->assertStatus(200)
            ->assertViewIs('posts.show');
    }

    /**
     * Test Put Post.
     *
     * @return void
     */
    public function testPutPost()
    {
        $user = factory(User::class)->create();
        $data = [];

        $response = $this
            ->actingAs($user)
            ->put('/posts/1', $data);

        $response->assertStatus(302);
    }

    /**
     * Test Put Post2.
     *
     * @return void
     */
    /* public function testPutpost2()
    {
        $data = [
            'title' => 'テスト投稿',
            'body' => 'test body',
        ];
        // $this->assertDatabaseMissing('posts', $data);

        $response = $this->put('/posts/2', $data);

        $response->assertStatus(302)
            ->assertRedirect('/posts/2');

        $this->assertDatabaseHas('posts', $data);
    } */

    /**
     * Test Put Empty Post Title.
     *
     * @return void
     */
    public function testPutEmptyPostTitle()
    {
        $user = factory(User::class)->create();
        $data = [
            'title' => ''
        ];
        $response = $this
            ->actingAs($user)
            ->from('/posts/4')
            ->put('/posts/4', $data);

        $response->assertSessionHasErrors(['title' => 'The title field is required.']);
        $response->assertStatus(302)
            ->assertRedirect('/posts/4');
    }

    /**
     * Test Put Empty Post Body.
     *
     * @return void
     */
    public function testPutEmptyPostBody()
    {
        $user = factory(User::class)->create();
        $data = [
            'body' => ''
        ];
        $response = $this
            ->actingAs($user)
            ->from('/posts/4')
            ->put('/posts/4', $data);

        $response->assertSessionHasErrors(['body' => 'The body field is required.']);
        $response->assertStatus(302)
            ->assertRedirect('/posts/4');
    }

    /**
     * Test Get Edit.
     *
     * @return void
     */
    public function testGetEdit()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get('/posts/1/edit');

        $response->assertStatus(200)
            ->assertViewIs('posts.edit');
    }

    /**
     * Test Get Edit.
     *
     * @return void
     */
    public function testGetCreate()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get('/posts/create');

        $response->assertStatus(200)
            ->assertViewIs('posts.create');
    }

    /**
     * Test Post Path.
     *
     * @return void
     */
    public function testPostPath()
    {
        $user = factory(User::class)->create();
        $data = [
            'title' => 'test title',
            'body' => 'test body',
            // 'user_id' => 1,
        ];
        //$this->assertDatabaseMissing('posts', $data);

        $response = $this
            ->actingAs($user)
            ->post('/posts/', $data);

        $response->assertStatus(302)
            ->assertRedirect('/posts/');

        $this->assertDatabaseHas('posts', $data);
    }

    /**
     * Test Post Path Empty Title And Body.
     *
     * @return void
     */
    public function testPostPathEmpryTitle()
    {
        $user = factory(User::class)->create();
        $data = [
            'title' => '',
            'body' => '',
        ];
        $response = $this
            ->actingAs($user)
            ->from('/posts/create')
            ->post('/posts/', $data);

        $response->assertSessionHasErrors(['title' => 'The title field is required.']);
        $response->assertSessionHasErrors(['body' => 'The body field is required.']);

        $response->assertStatus(302)
            ->assertRedirect('/posts/create');
    }
}
