@extends('layouts.app')

@section('content')
@guest
    <h1>Login Required!</h1>
    <a href="/login">Go back.</a>
    @else
        @if (Auth::user()->name == $allTweets['0']->author)
        <form action="/tweet" method="post">
            @csrf
            <h2>Edit Tweet</h2>
        <input type="hidden" name="id" value="{{$allTweets['0']->id}}">
        <label for="author">Author : {{$allTweets['0']->author}}</label>
        <input type="hidden" name="author" value="{{$allTweets['0']->author}}"><br/>
        <p><strong>Date Created : </strong>{{date('m-d-Y', strtotime($allTweets['0']->created_at))}}</p>
        <label for="content">Content : </label>
        <textarea name="content" cols="100" rows="5">{{$allTweets['0']->content}}</textarea>
        @error('content')
        <i  style="color: red">{{$message}}</i><br/>
        @enderror<br/>
        <input type="submit" value="Edit Tweet">
        </form>
        @else
            <h1>Nope!</h1>
            <a href="/frontPage">Go back!</a>
        @endif

@endguest

@endsection
