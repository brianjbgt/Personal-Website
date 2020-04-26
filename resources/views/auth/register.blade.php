@extends('layouts.app')

@section('title','Personal - Registration')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="uname" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="uname" type="text" class="form-control @error('uname') is-invalid @enderror" name="uname" value="{{ old('uname') }}" required autocomplete="uname" maxlength=45 autofocus>

                                @error('uname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>"Please enter a username."</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div id="adpw">
                            <div class="form-group row">
                                <label for="acctType" class="col-md-4 col-form-label text-md-right">Account Type</label>
                                <div class="btn-group col-1" role="group">
                                    <div class="custom-control custom-radio custom-control-inline"  >
                                        <input type="radio" class="custom-control-input" id="defaultInline1" name="acctType" value="0" @click="disabled = true" checked="checked">
                                        <label class="custom-control-label" for="defaultInline1">Regular</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="defaultInline2" name="acctType" value="1"  @click="disabled = false">
                                        <label class="custom-control-label" for="defaultInline2">Admin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Authorize Admin Creation</label>
                                <div class="col-md-6">
                                    <input id="adpassword" type="password" :disabled="disabled == true" class="form-control @error('adpassword') is-invalid @enderror" name="adpassword" autocomplete="new-password" placeholder="Admin Password" maxlength="30" style="width:155px">
                                    @error('adpassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Authorization Failed. Please Enter admin password.</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/register.js') }}"></script> 

@endsection
