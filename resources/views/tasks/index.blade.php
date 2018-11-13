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

        <h2 style="text-align: center">Task List</h2><br/>

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

        <div class="form-group col-md-12">
            <form action="{{ route('tasks.store') }}" method='POST'>
                {{ csrf_field() }}

                <div class="col-md-9">
                    <input type="text" name='taskName' class='form-control'>
                </div><br />

                <div class="col-md-3">
                    <input type="submit" class='btn btn-primary btn-block' value='Add Task'>
                </div>
            </form>
        </div>

        {{--Return a list of saved Tasks--}}
        @if(count($savedTasks) > 0)
            <table class="table">
                <thead class="thead-dark">
                    <th>#</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                @foreach ($savedTasks as $savedTask)
                    <tr>
                        <th>{{ $savedTask->id }}</th>
                        <td>{{ $savedTask->name }}</td>
                        <td><a href="{{ route('tasks.edit', ['tasks' => $savedTask->id]) }}" class="btn btn-default">Edit</a></td>
                        <td>
                            {{--Delete functionality Delete tasks from the table--}}
                            <form action="{{route('tasks.destroy', ['tasks'=> $savedTask ->id]) }}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name='_method' value='DELETE'>
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

</body>
</html>
