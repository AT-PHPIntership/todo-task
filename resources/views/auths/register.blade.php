@extends('layouts.auth')

@section('content')

  @include('common.errors')
  <section class="register-section d-flex" style="margin-top: 100px;">
    <form action="/account/create" method="post" class="col-md-4 m-auto align-middle">
    <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
      <div class="form-group">
        <label for="name" class="control-label">Fullname:</label>
        <input type="text" name="name" id="name" class="form-control">
      </div>
      <div class="form-group">
        <label for="email" class="control-label">Email:</label>
        <input type="text" name="email" id="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="password" class="control-label">Password:</label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <div class="form-group">
        <label for="confirm" class="control-label">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary col-md-12">Sign up</button>
      <a href="/"><input type="button" class="btn btn-default col-md-12 mt-3" value="Cancel"></a>
    </form>
  </section>
@endsection
