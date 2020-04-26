@extends('layouts.app')
@section('title','Personal - Work')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="float-left">
                <h1>Your Work Experience</h1>
            </div>
            <div class="float-right">
                <a class ="btn btn-success" href="/work/{{Auth::user()->profile->id}}/create"> Add Work </a>
            </div>
        </div>
    </div>

    @foreach($data['work'] as $work)
    <hr/>  
        <div class="row">
            <div class="col-md-12">
                <div class="float-left">
                    <h2>{{$work->company}}</h2>
                    <h4>{{$work->address}}</h4>
                </div>
                <div class="float-right">
                    <h4>{{$work->period}}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul>
                @foreach($data['workdesc'] as $workdesc)
                    @if($work->id == $workdesc->work_id)
                        <li>{{$workdesc->description}}</li>
                    @endif
                @endforeach
                </ul>
            </div>
            <div class="float-right">
                <form action="/work/{{$work->id}}" method="POST">
                    <a class="btn btn-primary" href="/work/{{$work->id}}/edit">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>  
        </div>
             
    @endforeach
</div>
@endsection
