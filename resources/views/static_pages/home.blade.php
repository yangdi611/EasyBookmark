@extends('layouts.default')

@section('content')
  <div class="jumbotron jumbotron-fluid">
    <h1 class="title m-mb-m">Hello Easy Bookmark!</h1>
    <p class="lead">
      This is a site that I will create for a long time by extending more modules into!
    </p>
    <p>
      A new journy begins!
    </p>
    <p>
      <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">Sign up now!</a>
    </p>
  </div>
@stop
