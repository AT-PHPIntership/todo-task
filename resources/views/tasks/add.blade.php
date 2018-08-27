@extends('layouts.app')

@section('content')
  <h1>Todo Tasks</h1>
  <div class="panel-body">

  <!-- will detele it later -->
    <form class="form-horizontal" method="POST" action="{{action('TaskController@store')}}">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label class="col-sm-3 control-label" for="name">Task name:</label>
        <div class="col-sm-6">
          <input class="form-control" type="text" name="name">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="tags">Tags:</label>
        <div class="col-sm-6">
          <textarea class="form-control" name="tags" id="tags" cols="30" rows="3"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> Add Task
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection
