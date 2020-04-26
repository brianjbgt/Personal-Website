@extends('layouts.app')
@section('namee','Personal - Home')
@section('title','Personal - Search')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h3>Search Results for </h3>
            </div>
        </div>
    </div>
    <hr/>
    <br/>
    @foreach($users as $user)
        <div class="row">
            <div class="col-sm-2 p-2">
                <a href="/profile/{{$user->id}}"><img src="{{$user->profile->profileImage()}}" class="rounded-circle profpic img-fluid" /></a>
            </div> 
            <div class="col-9 p-5">
                <div><a href="/profile/{{$user->id}}"><h1>{{$user->profile->name}}</h1></a></div>
                <div><h3>Email: {{$user->profile->email}}</h3></div>
                <div><h3>Number: {{$user->profile->number}}</h3></div>
            </div>  
        </div>
        <hr/>        
    @endforeach
    {{ $users->links() }}
</div>
@endsection
