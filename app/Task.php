<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
  protected $primaryKey = 'task_id';
  protected $table = 'tasks';

  public function tags()
  {
      return $this->belongsToMany('App\Tag', 'tag_tasks', 'task_id', 'tag_id');
  }
}
