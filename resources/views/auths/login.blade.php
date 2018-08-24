@extends('layouts.app')

@section('content')
  <section class="login-section">
    @include('common.errors')
    <form action="/login" method="post" class="form-horizontal col-md-4 m-auto">
    <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
      <div class="form-group">
        <label for="email" class="control-label">Email:</label>
        <input type="text" name="email" id="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="password" class="control-label">Password:</label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <a href="/register" class="d-block pb-2 ">Create new account</a>
      <button type="submit" class="btn btn-primary col-md-12">Sign in</button>
    </form>
  </section>
@endsection
