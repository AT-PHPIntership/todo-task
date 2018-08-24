@extends('layouts.app')

@section('content')
<div>
  <a href="{{ url('task/create')}}">Create new task</a>
</div>
@if (count($tasks) > 0)
  <div class="panel panel-default">
    <div class="panel-heading">
        Current Tasks
    </div>

    <div class="panel-body">
      <table class="table table-striped task-table">

        <!-- Table Headings -->
        <thead>
        <th>Task name</th>
        <th>Hash tag</th>
          <th>&nbsp;</th>
        </thead>

        <!-- Table Body -->
        <tbody>
          @foreach ($tasks as $task)
          <tr>
            <!-- Task Name -->
            <td class="table-text">
              <div>{{ $task->name }}</div>
            </td>
            <td class="table-text">
            <!-- a foreach to dis play all task 's -->
              <div>
                <span>#{{ $task->tags }}</span>
              </div>
            </td>
            <td>
                <!-- TODO: Delete Button -->
              <!-- <a href="{{ url('task/'.$task->id) }}">Delete</a> -->
              <form action="{{ url('task/delete') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$task->task_id}}">
                <button type="submit" class="btn btn-danger">
                  <i class="fa fa-trash"></i> Delete
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif
@endsection
