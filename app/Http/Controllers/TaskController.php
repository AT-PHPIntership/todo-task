<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use App\Tag;
use App\TagTask;
use App\UserTask;
use DB;
use Session;
class TaskController extends Controller
{
  public function index() {
    $user_id = \Session::get('user_id');
    $tasks = Task::select('*')->where('user_id', $user_id)->get();
    return view('tasks.index')->with('tasks', $tasks);
  }

  public function create() {
    return view('tasks.add');
  }

  public function store(Request $request) {
    $task = new Task;
    $tag = new Tag;
    $tag_task = new TagTask;
    $user_task = new UserTask;

    $allTagObj = Tag::all();
    $newTagStr = $request->tags;
    $newTagArr = explode(',', $newTagStr);
    $task->name = $request->name;
    $task->user_id = \Session::get('user_id');
    $task->save();

    foreach($newTagArr as $newTag) {
      $gettag = Tag::select('*')->where('name', $newTag)->first();
      if (count($gettag) > 0) {
        $tag_task->tag_id = $gettag->tag_id;
      } else {
        $tag->name = $newTag;
        $tag->save();
        $tag_task->tag_id = $tag->id;
      }
      $timenow = date('Y-m-d H:i:s', time());
      DB::table('tag_tasks')->insert(
        ['tag_id' => $tag_task->tag_id, 'task_id' => $task->id, 'created_at' => $timenow, 'updated_at' => $timenow]
      );
    }
    if (count($tag_task)>0) {
      // show notify and redirect
      echo  'add task success';
    }
  }
}
