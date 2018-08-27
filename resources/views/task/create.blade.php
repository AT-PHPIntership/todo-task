<html>
    <head>
        <meta charset="utf-8">
        <title>Task Management</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
    </head>
    <body>
        <div class="container">
            <h2>Management Task Screen. I am Ho Dang Nguyen</h2>
            <form method="post" action="{{action('TaskController@store')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <label for="Name">Name:</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <label for="Hashtag">Hashtag:</label>
                        <input type="text" class="form-control" name="hashtag">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <lable for="Status">Task status</lable>
                        <select name="status">
                            <option value="0">Do-ing</option>
                            <option value="1">Done</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <button class="btn btn-primary" type="submit" style="margin-top:10px" >Create</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>