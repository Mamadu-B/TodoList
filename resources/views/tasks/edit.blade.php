<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- bootstrap css CDN --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    {{-- bootstrap js CDN --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Todo List</title>
</head>
<body>
<div class="container">
    <div class="col-md-offset-2 col-md-8">

        <h2 style="text-align: center">Task Edition</h2><br/>

        {{--Return error message for adding tasks--}}
        @if( count($errors)> 0)
            <strong>Error:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{--Return success message--}}
        @if (Session::has('success'))
            <div class="alert alert-success">
                <strong>Success:</strong>
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="row">
            <form action="{{ route('tasks.update', [$editTaskName]) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">

                <div class="form-group">
                    <input type="text" name="updatedTaskName" class='form-control'value='{{ $editTaskName->name }}'>
                </div>

                <div class="form-group">
                    <input type="submit" value='Save Changes' class='btn btn-success'>
                    <a href="" class='btn btn-danger pull-right'>Go Back</a>
                </div>
            </form>
        </div>


    </div>
</div>

</body>
</html>
