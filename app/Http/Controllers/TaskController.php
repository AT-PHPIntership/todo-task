<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use App\Tag;
use App\TagTask;
use App\UserTask;
use Session;
use DB;
class TaskController extends Controller
{
  public function index() {
    $user_id = $_COOKIE['user_id'];

    $tasks = Task::select('*')
    ->where('user_id', '=' , $user_id)
    ->with('tags')
    ->get();
    // dd($tasks);
    // $tasksData = [];
    // foreach ($tasks as $task) {
    //   $tagList = '';
    //   // $taskLength = $task->length;
    //   foreach ($task->tags as $key=>$tag) {
    //     $tagList .='#'. $tag->name;
    //     if ($key < count($task->tags) - 1) {
    //       $tagList .=', ';
    //     }
    //   }
    //   $task->tags = $tagList;
    //   array_push($tasksData, $task);
    // }
    return view('tasks.index')->with('tasks', $tasks);
  }

  public function create() {
    return view('tasks.add');
  }

  public function store(Request $request) {
    $task = new Task;
    $tag_task = new TagTask;

    $allTagObj = Tag::all();
    $newTagStr = $request->tags;
    $newTagStr = str_replace(' ', '', $newTagStr);
    $newTagArr = explode(',', $newTagStr);
    $newTagArr = array_unique($newTagArr);
    if (!end($newTagArr)) {
      array_pop($newTagArr);
    }
    $task->name = $request->name;
    $task->user_id = $_COOKIE['user_id'];
    $task->save();

    foreach($newTagArr as $newTag) {
      $gettag = Tag::select('*')->where('name', $newTag)->first();
      if (count($gettag) > 0) {
        $tag_task->tag_id = $gettag->tag_id;
      } else {

        $tag = new Tag;
        $tag->name = $newTag;
        $tag->save();
        $tag_task->tag_id = $tag->tag_id;
      }
      $timenow = date('Y-m-d H:i:s', time());
      DB::table('tag_tasks')->insert(
        ['tag_id' => $tag_task->tag_id, 'task_id' => $task->task_id, 'created_at' => $timenow, 'updated_at' => $timenow]
      );
    }
    if (count($tag_task)>0) {
      Session::flash('message', 'Successfully add the task!');
      return redirect('/tasks');
    }
  }

  public function delete(Request $request)
  {
    $task = Task::find($request->id);
    $task->delete();
    Session::flash('message', 'Successfully deleted the task!');
    return redirect('/tasks');
  }
}
