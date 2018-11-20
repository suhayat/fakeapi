@extends('layouts.master')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <b>{{ config('app.name', 'Zeta Cell') }}</b>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">{{ __('LOGIN USER') }}</p>
    {{ Form::open(['role' => 'form']) }}
      <div class="form-group has-feedback">
        <input type="text" placeholder="username or email" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" placeholder="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          @if ($errors->has('username'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('username') }}</strong>
              </span>
          @endif
          @if ($errors->has('password'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    {{ Form::close() }}
    <a href="{{ route('password.request') }}">I forgot my password</a><br>
  </div>
</div>
@endsection