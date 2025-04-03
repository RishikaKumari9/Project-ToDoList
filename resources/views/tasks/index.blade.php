<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Task List</h1>
    <input type="text" id="task" placeholder="Enter task" required>
    <button id="addTask">Add Task</button>
    <button id="showAllTasks">Show All Tasks</button>
    <ul id="taskList">
        @foreach($tasks as $task)
            <li data-id="{{ $task->id }}">
                <input type="checkbox" class="completeTask" {{ $task->is_completed ? 'checked' : '' }}>
                {{ $task->task }}
                <button class="deleteTask">Delete</button>
            </li>
        @endforeach
    </ul>

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
                        $('#taskList').append(`<li data-id="${data.id}">
                            <input type="checkbox" class="completeTask">
                            ${data.task}
                            <button class="deleteTask">Delete</button>
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
                            <input type="checkbox" class="completeTask" ${task.is_completed ? 'checked' : ''}>
                            ${task.task}
                            <button class="deleteTask">Delete</button>
                        </li>`);
                    });
                });
            });
        });
    </script>
</body>
</html>
