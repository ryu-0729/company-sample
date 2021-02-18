<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $soft_delete_users = User::onlyTrashed()->get();
        //dd($soft_delete_users);
        return view('admin.index', [
            'soft_delete_users' => $soft_delete_users
        ]);
    }
}
