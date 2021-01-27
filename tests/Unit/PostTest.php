<?php

namespace Tests\Unit;

use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{

    /**
     * Test Post Data.
     *
     * @return void
     */
    public function testPostData()
    {
        $posts = Post::all();
        $this->assertEquals(10, count($posts));
    }

    /**
     * Test Post Data.
     *
     * @return void
     */
    public function testPostShow()
    {
        $post = Post::find(2);
        $this->assertEquals('テスト投稿', $post->title);
        $this->assertEquals('test body', $post->body);
    }

    /**
     * Test Post Not Data.
     *
     * @return void
     */
    public function testPostShowNotData()
    {
        $post = Post::find(0);
        $this->assertNull($post);
    }

}
