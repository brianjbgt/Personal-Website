@extends('layouts.app')
@section('title','Personal - Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{$data['user']->profile->profileImage()}}" class="rounded-circle profpic" />
        </div>
        <div class="col-9 p-5">
            <div><h1>{{$data['user']->profile->name}}</h1></div>
            <div><h3>Email: {{$data['user']->profile->email}}</h3></div>
            <div><h3>Number: {{$data['user']->profile->number}}</h3></div>
            <div><h3>Objective: {{$data['user']->profile->objective}}</h3></div>
            <div class="float-right">
                @can('update',$data['user']->profile)
                    <a class="btn btn-primary" href="/profile/{{$data['user']->id}}/edit">Edit Profile</a>
                @endcan
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="float-left">
                <h1>Skills</h1>
            </div>
        </div>
    </div>

    <ul>
    @foreach($data['skill'] as $skill)
        <li>{{$skill->skill_desc}}</li>      
    @endforeach
    </ul>

    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="float-left">
                <h1>Work Experience</h1>
            </div>
        </div>
    </div>

    @foreach($data['work'] as $work) 
    <div class = "col">
        <div class = "col">
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
            </div>
        </div>
    </div>
    @endforeach
</div>


<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<!-- <script src="{{ asset('js/home.js') }}"></script>  -->
@endsection
