<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

//ログインユーザーの取得のため追記
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserPost; //追記

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per_page = 10;

        //投稿したユーザーも取得
        $posts = Post::with('user')->where(function ($query) {
            //検索で入力された値があればデータをあいまい検索で絞る
            if ($search = request('search')) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('body', 'LIKE', "%{$search}%");
            }
        })->paginate($per_page);
        //dd($posts);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPost $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user()->id;
        $post->save();
        
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $response = Gate::inspect('update', $post);

        if ($response->allowed()) {
            return view('posts.edit', [
                'post' => $post,
            ]);
        } else {
            return redirect('/posts');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPost $request, $id)
    {
        $post = Post::findOrFail($id);

        $response = Gate::inspect('update', $post);
        
        if ($response->allowed()) {
            $fillData = [];
            if (isset($request->title)) {
                $fillData['title'] = $request->title;
            }

            if (isset($request->body)) {
                $fillData['body'] = $request->body;
            }

            if (count($fillData) > 0) {
                $post->fill($fillData);
                $post->save();
            }
            return redirect('/posts/' . $id);
        } else {
            return redirect('/posts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $response = Gate::inspect('delete', $post);

        if ($response->allowed()) {
            $post->delete();
            return redirect('/posts');
        } else {
            return redirect('/posts');
        }
        /* Post::destroy($id);
        return redirect('/posts'); */
    }
}
