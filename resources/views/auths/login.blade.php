@extends('layouts.app')

@section('content')
  <div>Login</div>
<form action="{{url('/login')}}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<input type="text" name="user_id" palceholder="user id">
<input type="submit" value="submit">
</form>
@endsection
