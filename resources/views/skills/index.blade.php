@extends('layouts.app')
@section('title','Personal - Skills')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h3>Your Skills</h3>
            </div>
            <div class="pull-right">
                <a class ="btn btn-success" href="/skills/{{Auth::user()->profile->id}}/create"> Add Skill </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Skill</th>
        <th>Action</th>
    </tr>
    @foreach($skills as $skill)
        <tr>
            <td>{{++$i}}</td>  
            <td>{{$skill->skill_desc}}</td>
            <td>
                <form action="/skills/{{$skill->id}}" method="POST">
                    <a class="btn btn-primary" href="/skills/{{$skill->id}}/edit">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>        
    @endforeach
    </table>
</div>
@endsection