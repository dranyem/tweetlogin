<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    function show(){
        $users = \App\User::all();
        $follows = \App\Follows::where('following', Auth::user()->name)->get();
        return view('users', ['users'=>$users,
                              'follows'=>$follows]);
    }
}
