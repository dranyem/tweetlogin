<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function show(){
        $tweets = \App\Tweet::orderBy('id','desc')->get();
        return view("profile", [ "allTweets" => $tweets]);
    }
    function createTweet(Request $request){
         $request->validate([
            'content' => 'required|min:3|max:10'
        ]);
        $tweet = new \App\Tweet();
        $tweet->author = $request->author;
        $tweet->content = $request->content;
        $tweet->save();

        $tweets =\App\Tweet::orderBy('id','desc')->get();
        return view("profile", [ "allTweets" => $tweets]);
    }
    function deleteTweet(Request $request) {
        \App\Tweet::destroy($request->id);

        $tweets = \App\Tweet::orderBy('id','desc')->get();
        return view("profile", [ "allTweets" => $tweets]);
    }

    function showEditTweet(Request $request){
        $tweet = \App\Tweet::find($request->id);
        return view('editTweet', [ "allTweets" => [$tweet]]);
    }
    function editTweet(Request $request){
        $request->validate([
            'content' => 'required|min:3|max:10'
        ]);

        $tweet = \App\Tweet::find($request->id);
        $tweet->author = $request->author;
        $tweet->content = $request->content;
        $tweet->save();

        $tweets = \App\Tweet::orderBy('id','desc')->get();
        return view("profile", [ "allTweets" => $tweets]);
    }
}
