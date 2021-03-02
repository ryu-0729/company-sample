<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // roleが開発者と社員のみ一覧表示
        $role = ['開発者', '社員'];
        $per_page = 20;
        $users = User::whereIn('role', $role)->paginate($per_page);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user = User::findOrFail($id)->posts;
        $user = User::findOrFail($id);
        $user_posts = $user->posts()->get();
        //dd($user_posts);
        return view('users.show', [
            'user' => $user,
            'user_posts' => $user_posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
        ]);

        $user = User::findOrFail($id);

        //変更可能な値を習得するためからの配列を用意
        $fillData = [];

        //フォームからの値を取得し$fillDataに代入
        if (isset($request->name)) {
            $fillData['name'] = $request->name;
        }

        //$fillDataの数が0以上だった場合に保存
        if (count($fillData) > 0) {
            $user->fill($fillData);
            $user->save();
        }

        return redirect('/users/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/users');
    }
}
