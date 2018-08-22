@extends('layouts.app')

@section('content')
  <h1>Todo Tasks</h1>
  <div>
    <strong>Currently ignore user login !!</strong>
  <!-- will detele it later -->
    <form method="POST" action="{{action('TaskController@store')}}">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <label for="name">Task name:</label>
      <input type="text" name="name">
      <label for="tags">Tags:</label>
      <textarea name="tags" id="tags" cols="30" rows="3"></textarea>
      <input type="submit" value="Add Task">
    </form>
  </div>
  <div>
  @if ($tasks)
    <h2>Task List</h2>
    <ul>
      @foreach ($tasks as $task)
      <li>{{$task->name}}</li>
      <input type="checkbox" id="{{$task->id}}">
      <!--  -->
      <a class="" href="{{ URL::to('task/' . $task->id) }}">Edit this sh!t</a>
      @endforeach
    </ul>
  @endif
  </div>
@endsection
