<!-- edit.blade.php -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edit a task</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> 
    </head>
    <body>
        <div class="container">
            <h2>Edit Task</h2><br  />
            <form method="post" action="{{action('TaskController@update', $id)}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input name="_method" type="hidden" value="PATCH">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{$task->name}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <label for="hashtag">Hashtag</label>
                        <input type="text" class="form-control" name="hashtag" value="{{$tagDatas}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4" style="margin-left:38px">
                        <lable>Status</lable>
                        <select name="status">
                            <option value="0"  @if($task->status=="0") selected @endif>Do-ing</option>
                            <option value="1"  @if($task->Status=="1") selected @endif>Doned</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4" style="margin-top:10px">
                        <button type="submit" class="btn btn-success" style="margin-left:0px">Update</button>
                    </div>
                </div>
            </form>   
        </div>
    </body>
</html>