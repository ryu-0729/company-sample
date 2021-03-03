<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Post;
use App\User;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user()->id;
        $comment->save();

        return redirect()->back();
    }
}
