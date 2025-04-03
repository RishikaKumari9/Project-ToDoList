<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(['task' => 'required|unique:tasks']);
        $task = Task::create(['task' => $request->task]);
        return response()->json($task);
    }

    public function complete($id)
    {
        $task = Task::findOrFail($id);
        $task->is_completed = 1;
        $task->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['success' => true]);
    }

    public function showAll()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

}
