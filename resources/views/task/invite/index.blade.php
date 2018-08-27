<html>
    <head>
        <meta charset="utf-8">
        <title>Task Management</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
    </head>
    <body>
        <div class="container">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
                <br />
            @endif
            
            <h2>People in my Task: </h2><br  />

            <div class="row">
                <div class="col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="{{$task->name}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" name="status" value="{{$task->status==1?'Doned':'Do-ing'}}">
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user['user_id']}}</td>
                            <td>{{$user['name']}}</td>
                            <td>
                                <form action="{{action('TaskController@inviteDestroy', $user['user_id'])}}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- //<a href="{{action('TaskController@inviteCreate', $task['task_id'])}}" class="btn btn-primary">Create</a> -->
            <form action="{{action('TaskController@inviteCreate', $task['task_id'])}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-4">
                        <label for="user_id">User name</label>
                        <select name="user_id" class="form-control">
                            @foreach($userAlls as $userAll)
                                <option value="{{$userAll->user_id}}">{{$userAll->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-4">
                        <button type='submit' class='btn btn-primary'>Add person</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>