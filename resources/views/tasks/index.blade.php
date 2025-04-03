<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">

        <div class="row">
            <div class="col-md-6 offset-3">
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-12">
                    <h1>Task List</h1>
                    <input type="text" id="task" placeholder="Enter your task" required>
                    <button id="addTask" class="btn btn-primary">Add Task</button>
                </div>
                <div class="col-md-12 mt-5">
                    <button id="showAllTasks" class="btn btn-primary">Show All Tasks</button>
                    <ul id="taskList" style="list-style: none;">
                        @foreach($tasks as $task)
                            <li data-id="{{ $task->id }}" class="mt-2">
                                {{ $task->id }}.
                                {{ $task->task }}
                                <button class="deleteTask btn btn-danger">Delete</button>
                                <input type="checkbox" class="completeTask" {{ $task->is_completed ? 'checked' : '' }}> Complete
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#addTask').click(function () {
                //alert('hello');
                let task = $('#task').val();
                $.ajax({
                    url: '/tasks',
                    type: 'POST',
                    data: {task: task, _token: '{{ csrf_token() }}'},
                    success: function (data) {
                        $('#taskList').append(`<li data-id="${data.id}" class="mt-2">
                            ${data.id}.
                            ${data.task}
                            <button class="deleteTask">Delete</button>
                            <input type="checkbox" class="completeTask btn btn-danger"> Complete
                        </li>`);
                        $('#task').val('');
                    }
                });
            });

            $(document).on('click', '.completeTask', function () {
                let id = $(this).closest('li').data('id');
                $.ajax({
                    url: `/tasks/${id}/complete`,
                    type: 'PATCH',
                    data: {_token: '{{ csrf_token() }}'},
                    success: function () {
                        $(`li[data-id="${id}"]`).fadeOut();
                    }
                });
            });

            $(document).on('click', '.deleteTask', function () {
                if (confirm('Are you sure you want to delete this task?')) {
                    let id = $(this).closest('li').data('id');
                    $.ajax({
                        url: `/tasks/${id}`,
                        type: 'DELETE',
                        data: {_token: '{{ csrf_token() }}'},
                        success: function () {
                            $(`li[data-id="${id}"]`).remove();
                        }
                    });
                }
            });

            $('#showAllTasks').click(function () {
                $.get('/tasks/showAll', function (data) {
                    $('#taskList').empty();
                    data.forEach(task => {
                        $('#taskList').append(`<li data-id="${task.id}">
                            ${task.id}.
                            ${task.task}
                            <button class="deleteTask">Delete</button>
                            <input type="checkbox" class="completeTask btn btn-danger" ${task.is_completed ? 'checked' : ''}> Completed
                        </li>`);
                    });
                });
            });
        });
    </script>
</body>
</html>
