<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('task/index', compact('tasks'));
    }

    public function create()
    {
        return view('task/create');
    }

    public function saveTask(Request $request)
    {
        $task = new Task;
        $task->task_title = $request->title;
        $task->description = $request->description;
        $task->user_id = Auth::id();
        if ($task->save()) {
            return response()->json(['status' => 'success', 'message' => 'Task created successfully']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Failed to create task']);
        }
    }

    public function editTask($id)
    {
        $task = Task::find($id);
        return view('task/edit', compact('task'));
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::find($id);
        $task->task_title = $request->title;
        $task->description = $request->description;
        if ($task->update()) {
            return response()->json(['status' => 'success', 'message' => 'Task updated successfully']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Failed to update task']);
        }
    }

    public function destroy($id)
    {
        Task::find($id)->delete($id);
        return response()->json([
            'status' => 'Task deleted successfully!'
        ]);
    }
}
