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
<h1>List of Users</h1>
    <hr>
    @foreach ($users as $user)
    <h2>{{$user->name}}</h2>
    @endforeach
@else
    <h1>List of Users</h1>
    <hr>
    @foreach ($users as $user)
    @if (!($user->name == Auth::user()->name))
    <h2>{{$user->name}}</h2>
        @if (checkFollowing($user->name, $follows))
            <p>Already following!</p>
        @else
            <form action="" method="post">
                @csrf
                <input type="submit" value="Follow">
            </form>
        @endif
    @endif
    @endforeach
    @endguest
@endsection
