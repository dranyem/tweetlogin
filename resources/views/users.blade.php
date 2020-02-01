@extends('layouts.app')

@php
    function checkFollowing($userToCheck, $follows){
        foreach ($follows as $follow) {
            if($follow->followed == $userToCheck){
                return true;
            }
        }
        return false;
    }
@endphp

@section('content')
@guest
<h1>Not logged in</h1>
<a href="/login">Login</a>
@else
    <h1>List of Users</h1>
    <a href="/profile">Go back to profile</a>
    <hr>
    @foreach ($users as $user)
    @if (!($user->name == Auth::user()->name))
    <h2>{{$user->name}}</h2>
        @if (checkFollowing($user->name, $follows))
            <form action="/userList/unfollow" method="post">
                @csrf
                <input type="hidden" name="following" value="{{Auth::user()->name}}">
                <input type="hidden" name="followed" value="{{$user->name}}">
                <label for="unfollow">Already following</label>
                <input type="submit" value="Unfollow">
            </form>
        @else
            <form action="/userList/follow" method="post">
                @csrf
                <input type="hidden" name="following" value="{{Auth::user()->name}}">
                <input type="hidden" name="followed" value="{{$user->name}}">
                <input type="submit" value="Follow">
            </form>
        @endif
    @endif
    @endforeach
    <hr>
    <h1>List of Tweets from followed Users</h1>
    @foreach ($tweets as $tweet)
    <div style="border: 1px dashed black">
        <p><strong style="color:blue">Content : </strong>{{ $tweet->content }}</p>
        <p><strong style="color:blue">Author : </strong>{{ $tweet->author }}</p>
        <p><strong style="color:blue">Date Created : </strong>{{date('m-d-Y', strtotime($tweet->created_at))}}</p>
    </div>
    @endforeach

    @endguest
@endsection
