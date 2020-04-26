@extends('layouts.app')
@section('title','Personal - Skills')
@section('content')
<div class="container">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Skill</div>

                <div class="card-body">
                    <form method="POST" action="/skill" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="skill_desc" class="col-md-4 col-form-label text-md-right">Skill Description</label>

                            <div class="col-md-6">
                                <input id="skill_desc" type="text" class="form-control @error('skill_desc') is-invalid @enderror" name="skill_desc" value="{{ old('skill_desc') }}" required autocomplete="skill_desc" maxlength=45 autofocus>

                                @error('skill_desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>"Please enter a Skill Description."</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Skills
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
