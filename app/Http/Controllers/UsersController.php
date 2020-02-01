<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    function show(){
        if(Auth::check()){
            $users = \App\User::all();
            $follows = \App\Follows::where('following', Auth::user()->name)->get();

            $following=[];
            foreach($follows as $follow){
                array_push($following, $follow->followed);
            }
            $tweets = \App\Tweet::whereIn('author',$following)->get();
            return view('users', ['users'=>$users,
                                'follows'=>$follows,
                                'tweets'=>$tweets]);
        }
        return view('auth.login');
    }

    function follow(Request $request){
        $follow = new \App\Follows();
        $follow->following = $request->following;
        $follow->followed = $request->followed;
        $follow->save();


        $users = \App\User::all();
        $follows = \App\Follows::where('following', Auth::user()->name)->get();

        $following=[];
        foreach($follows as $follow){
            array_push($following, $follow->followed);
        }
        $tweets = \App\Tweet::whereIn('author',$following)->get();
        return view('users', ['users'=>$users,
                              'follows'=>$follows,
                              'tweets'=>$tweets]);
    }

    function unfollow(Request $request){
        \App\Follows::where('following', $request->following)
                    ->where('followed', $request->followed)
                    ->delete();

        $users = \App\User::all();
        $follows = \App\Follows::where('following', Auth::user()->name)->get();
        $following=[];
        foreach($follows as $follow){
            array_push($following, $follow->followed);
        }
        $tweets = \App\Tweet::whereIn('author',$following)->get();
        return view('users', ['users'=>$users,
                              'follows'=>$follows,
                              'tweets'=>$tweets]);
    }
}
