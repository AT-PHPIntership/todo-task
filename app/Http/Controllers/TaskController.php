<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;

class TaskController extends Controller
{
  public function index() {
    // return view('tasks.tasks');
    $tasks = Task::all();
    return view('tasks.index')->with('tasks', $tasks);
  }

  public function store(Request $request) {
    $taks = new Task;
    $taks->name = $request->name;
    $taks->tags = $request->tags;

    $taks->save();
    return view('tasks.tasks');
  }
}
