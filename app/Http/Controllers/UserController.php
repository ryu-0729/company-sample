<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

//ログインユーザーの取得のため追記
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditUser; //追記

class UserController extends Controller
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
    public function index(Request $request)
    {
        $role = ['開発者', '社員'];
        $per_page = 20;

        //roleが開発者と社員のみ一覧表示
        $users = User::whereIn('role', $role)->where(function ($query) {
            //検索で入力された値があればデータをあいまい検索で絞る
            if ($search = request('search')) {
                $query->where('name', 'LIKE', "%{$search}%");
                //dd($search);
            }
        })->paginate($per_page);
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
        $login_user_id = Auth::id();

        //簡易的な権限設定
        if ($user->id === $login_user_id) {
            return view('users.edit', [
                'user' => $user,
            ]);
        } else {
            return redirect('/users');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(EditUser $request, $id)
    {
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
