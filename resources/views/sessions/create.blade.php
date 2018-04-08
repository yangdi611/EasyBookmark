@extends('layouts.default')
@section('title', '登录')

@section('content')
<div class="offset-md-2 col-md-8">
  <div class="card">
    <div class="card-header">
      <h5>Sign in</h5>
    </div>
    <div class="card-body">
      @include('shared._errors')

      <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
          </div>

          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
          </div>

          <button type="submit" class="btn btn-primary">Sign in</button>
      </form>

      <hr>

      <p>Don't have an account?<a href="{{ route('signup') }}">&nbsp Sign up now!</a></p>
    </div>
  </div>
</div>
@stop
