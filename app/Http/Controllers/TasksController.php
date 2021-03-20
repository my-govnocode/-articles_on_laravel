<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::get();
        return view('task', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('index', compact('task'));
    }
}
