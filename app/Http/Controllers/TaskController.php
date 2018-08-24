<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use App\Tag;
use App\TagTask;
use App\UserTask;
use DB;
// use Cookie;
class TaskController extends Controller
{
  public function index() {
    $user_id = $_COOKIE['user_id'];
    // $tasks = Task::select('*')->where('user_id', $user_id)->get();
    // $tasks = DB::table('tag_tasks')
    //             ->join('tasks', 'tasks.task_id', '=', 'tag_tasks.task_id')
    //             ->join('tags', 'tag_tasks.tag_id', '=', 'tags.tag_id')
    //             ->select('tasks.name', 'tasks.status', 'tags.name')
    //             ->where('user_id', $user_id)->get();

    $tasks = Task::select('*')
    ->where('user_id', '=' , $user_id)
    ->with('tags')
    ->get();
    // dd($tasks);
    $tasksData = [];
    foreach ($tasks as $task) {
      $tagList = '';
      foreach ($task->tags as $tag) {
        $tagList .= $tag->name .',';
      }
      $task->tags = $tagList;
      array_push($tasksData, $task);
    }
    // foreach ($tasksData as $tas) {
    // dd($tas);
    // }
    // echo '<pre>';

    // dd($tasks->first());
    // foreach($tasks as $task) {
    //   dd($task->tags->first()->name);
    // }
  // dd($tasks->first());
    return view('tasks.index')->with('tasks', $tasksData);
  }

  public function create() {
    return view('tasks.add');
  }

  public function store(Request $request) {
    $task = new Task;
    $tag_task = new TagTask;

    $allTagObj = Tag::all();
    $newTagStr = $request->tags;
    $newTagArr = explode(',', $newTagStr);
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
      // show notify and redirect
      echo  'add task success';
    }
  }
}
