@extends('layouts.app')
@section('title','Personal - Skills')

@section('content')
<div class="container">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Work</div>

                <div class="card-body">
                    <form method="POST" action="/work" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Job Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" maxlength=45 autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>"Please enter a Job Title."</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="period" class="col-md-4 col-form-label text-md-right">Time Period</label>

                            <div class="col-md-6">
                                <input id="period" type="text" class="form-control @error('period') is-invalid @enderror" name="period" value="{{ old('period') }}" required autocomplete="period" maxlength=45 autofocus>

                                @error('period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>"Please enter a Time Period."</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company" class="col-md-4 col-form-label text-md-right">Company</label>

                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" required autocomplete="company" maxlength=45 autofocus>

                                @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>"Please enter a Company."</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" maxlength=80 autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>"Please enter an Address."</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Job Description</label>
                            <div class="col-md-6">
                                <div id="jobdesc">
                                    <div v-for="(input, k) in inputs" :key="k">
                                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" 
                                        value="{{ old('description') }}" required autocomplete="description" maxlength=45 v-model="input.name" :name="'description' + k" autofocus>
                                        <span class="float-right">
                                            <i class="fas fa-minus-circle" v-on:click="remove(k)" v-show="k || ( !k && inputs.length > 1)"></i>
                                            <i class="fas fa-plus-circle" v-on:click="add(k)" v-show="k == inputs.length-1"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>"Please enter a Job Description."</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Work Details
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
