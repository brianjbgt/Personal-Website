@extends('layouts.app')
@section('namee','Personal - Home')
@section('title','Personal - Education')

@section('content')
<div id="app">
    <education-component :id="{{$profile->id}}"></education-component>
</div>
@endsection
