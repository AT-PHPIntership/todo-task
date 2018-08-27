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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Hashtag</th>
                        <th colspan='3'>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{$task['task_id']}}</td>
                            <td>{{$task['name']}}</td>
                            <td>{{  $task['status']==0?'Do-ing':'Doned'  }}</td>
                            <td>{{    $tagDatas[$task['task_id']]    }}</td>
                            <td><a href="{{action('TaskController@invite', ['id' => $task['task_id']])}}" class="btn btn-success">Invite</a></td>
                            <td><a href="{{action('TaskController@edit', $task['task_id'])}}" class="btn btn-warning">Edit</a></td>
                            <td>
                                <form action="{{action('TaskController@destroy', $task['task_id'])}}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{action('TaskController@inviteCreate', ['id' => $task['task_id']])}}" class="btn btn-primary">Create</a>
        </div>
    </body>
</html>