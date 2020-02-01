@extends('layouts.app')
@section('content')
    @guest
     <h2>Login required</h2>
     <a href="/login">Go back</a>
    @else

    <h1>Welcome {{Auth::user()->name}}</h1>
    <a href="/userList">List of Users</a>
    <form action="/createTweet" method="post">
        @csrf
        <label for="author">Author : {{Auth::user()->name}}</label>
        <input type="hidden" name="author" value="{{Auth::user()->name}}"><br/>
        @error('author')
        <i style="color: red">{{$message}}</i><br/>
        @enderror
        <label for="content">Content : </label>
        <textarea name="content" cols="100" rows="5"></textarea>
        @error('content')
        <i  style="color: red">{{$message}}</i><br/>
        @enderror<br/>
        <input type="submit" value="Create Tweet">
    </form>


    <hr>
    <h1>List of Tweets : </h1>
    @foreach ($allTweets as $tweet)
    <div style="border: 1px dashed black">
    <p><strong style="color:blue">Content : </strong>{{ $tweet->content }}</p>
    <p><strong style="color:blue">Author : </strong>{{ $tweet->author }}</p>
    <p><strong style="color:blue">Date Created : </strong>{{date('m-d-Y', strtotime($tweet->created_at))}}</p>
        @if ($tweet->author == Auth::user()->name)
        <form action="/deleteTweet" method="post">
            @csrf
            <button name="id" type="submit" value="{{ $tweet->id }}" >Delete Tweet</button>
        </form>
        <form action="/tweet" method="get">
            <button name="id" type="submit" value="{{ $tweet->id }}">Edit Tweet</button>
        </form>
        @endif
    </div>
@endforeach
@endguest
@endsection
