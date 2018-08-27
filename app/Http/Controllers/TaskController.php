<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use App\Task;
use App\Tag;
use App\TagTask;
use App\UserTask;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // echo '<pre>';
        // var_dump(DB::select('select * from tasks where user_id = ?', [1]));
        // $tasks = \App\Task::all();
        // die;
        
        // $tasks = DB::select('select * from tasks where user_id = ?', [1]);

        $tasks = Task::select('*')
                        ->where('user_id', '=' , 1)
                        ->with('tags')
                        ->get();
        // dd($tasks);
        $tagDatas = array();
        foreach($tasks as $task)
        {
            // dd($task->task_id);
            $tagDatas[$task->task_id] = '';
            foreach($task->tags as $tag) 
            {
                $tagDatas[$task->task_id] .= $tag->name . ', ';
            }
            $last_space_position = strrpos($tagDatas[$task->task_id], ', ');
            $tagDatas[$task->task_id] = substr($tagDatas[$task->task_id], 0, $last_space_position);

        }

        // dd($tagDatas);
        
        // echo '<pre>';
        // var_dump($tasks);
        // die;

        return view('task/index')->with(['tasks' => $tasks, 'tagDatas' => $tagDatas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("task/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $tag = new Tag;
        $tag_task = new TagTask; 
        $task = new \App\Task;

        $task->name = $request->get('name');
        $task->user_id = 1;
        $task->status = 0;

        $allTagObj = Tag::all();
        $newTagStr = $request->hashtag;
        // dd($newTagStr);
        $newTagArr = explode(', ', $newTagStr);
        
        $task->save();

        foreach($newTagArr as $newTag) {
            $gettag = Tag::select('*')->where('name', strtoupper($newTag))->first();
            if (count($gettag) > 0) {
                $tag_task->tag_id = $gettag->tag_id;
            } else {
                $tag = new Tag;
                $tag->name = strtoupper($newTag);
                $tag->save();
                $tag_task->tag_id = $tag->tag_id;
            }
            // $timenow = date('Y-m-d H:i:s', time());
            DB::table('tag_tasks')->insert(
              ['tag_id' => $tag_task->tag_id, 'task_id' => $task->task_id]
            );
        }
        if (count($tag_task)>0) {
            // show notify and redirect
            echo  'add task success';
        }

        return redirect('tasks')->with('success', 'Task has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = \App\Task::find($id);

        $tagDatas = '';
        foreach($task->tags as $tag) 
        {
            $tagDatas .= $tag->name . ', ';
        }
        $last_space_position = strrpos($tagDatas, ', ');
        $tagDatas= substr($tagDatas, 0, $last_space_position);

        // return view('passport/edit', compact('passport','id'));
        return view('task/edit')->with(['task' => $task, 'id' => $id, 'tagDatas' => $tagDatas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        //
        // dd('abv');
        $task = \App\Task::find($id);
        $task->name = $request->name;
        $task->status = $request->status;
        $task->save();

        //hashtag
        // $allTagObj = Tag::all();
        // $newTagStr = $request->hashtag;
        // // dd($newTagStr);
        // $newTagArr = explode(', ', $newTagStr);
        // // dd($newTagArr);
        // $listTag = $task->tags;
        // dd($listTag);
        // //Add the new tag
        // foreach($newTagArr as $everyTag) {
        //     $everyTag = TagTask::select('*')
        //                 ->where('task_id', '=' , $task->task_id)
        //                 ->where('tag_id', '=', $tag->tag_id)
        //                 ->first();
        //     // dd($newTag);
        // }

        //Remove the old tag
        // dd($task);
        return redirect('tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = \App\Task::find($id);
        $task->delete();
        return redirect('tasks')->with('success','Information has been deleted');
    }

    /**
     * Invite new user to control task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invite($id)
    {
        $task = \App\Task::find($id);
        $userAlls = \App\User::all();
        return view('task/invite/index')->with(['task'=>$task, 'id'=>$id, 'userAlls'=>$userAlls, 'users'=>$task->users]);
    }


    public function inviteCreate(Request $request, $id) 
    {
        //
        // dd($request->user_id);

        $user_task = UserTask::select('*')
                                ->where('user_id', '=', $request->user_id)
                                ->where('task_id', '=', $id)
                                ->first();
        // dd(count($user_task));
        if(count($user_task)==0)
        {
            $user_task_temp = new UserTask;
            $user_task_temp->user_id = $request->user_id;
            $user_task_temp->task_id = $id;
            $user_task_temp->save();
        }
        return redirect("tasks/$id/invite");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inviteStore(Request $request, $id)
    {
        
        return redirect('tasks/invite/index');
    }

    public function inviteDestroy($id)
    {
        dd($id);
        // $user_task = \App\UserTask::find($id);
        $user_task = UserTask::select('*')
                                ->where('user_id', '=', $id)
                                ->first();
        // dd(count($user_task));
        $user_task->delete();
        return redirect("tasks/$id/invite")->with('success','Information has been deleted');
    }

}
