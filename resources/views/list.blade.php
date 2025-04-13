<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Your ToDo List</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="text-align: center">


<div class="container">

    <div class="row">
        <div class="col-md-6 offset-3">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Your ToDo List</th>

                    <th scope="col">Completed</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp




                    @foreach($todos as $todo)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $todo->title }}</td>
                        <td>

                            <a href="{{ asset('/',$todo->id,'/completed') }}">
                                {{-- <input type="checkbox" name="complete"> --}}
                                <input type="checkbox" class="completeTask" {{ $todo->is_completed ? 'checked' : '' }}>
                            </td>

                        <td>
                        <form action="{{ route('items.destroy', $todo->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure,You want to delete Task?')">Delete</button>
                        </form>
                    </td>


                      </tr>
                     @endforeach
                </tbody>
              </table>

        </div>
    </div>
</div>
<h4>
<a href="/create">Add task</a>
</h4>
</body>
</html>
