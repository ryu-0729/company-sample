<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;

class PostApiControllerTest extends TestCase
{
    use RefreshDatabase; //既存のデータに依存しない
    

    //全投稿データの取得APIテスト
    public function testGetAllPostPath()
    {
        $user = factory(User::class)->create(); //ログインユーザーの準備
        $response = $this->actingAs($user, 'api')
            ->get('/api/posts'); //Getリクエスト

        $response->assertStatus(200); //レスポンスは正常か確認
    }

    //新規投稿APIのテスト
    public function testPostPostPath()
    {
        $user = factory(User::class)->create(); //ログインユーザーの準備

        $postData = [
            'title' => 'test post',
            'body' => 'test body',
        ];

        $response = $this->actingAs($user, 'api')
            ->postJson('/api/posts', $postData);

        $response->assertStatus(201);
    }
}
