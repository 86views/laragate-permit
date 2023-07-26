<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
//   public function __construct()
//   {
//     $this->authorizeResource(Task::class, 'task');
//   }

    public function index() 
    {
        $tasks =  Task::with('user')->orderBy('due_date')->get();

        return view('admin.tasks.index', compact('tasks'));
    }

    public function create() 
    {
         $this->authorize('create',  Task::class);
        return view('admin.tasks.create');
    }

    Public  function store(Request $request) 
    {
        $this->authorize('create',  Task::class); 
        Task::create($request->only('description', 'dueDate'));
        return  redirect()->route('admin.tasks.index');
    }

    public function edit(Task $task) 
    {
         $this->authorize('update',  $task);
        return view('admin.tasks.edit');
    }
    Public  function update(Request $request, Task $task) 
    {
        $this->authorize('update',  $task);
        $task->update($request->only('description', 'due_date'));
        return  redirect()->route('admin.tasks.index');
    }

    public function delete(Task $task) 
    {
        $this->authorize('delete',  $task);
        $task->delete();
        return  redirect()->route('admin.tasks.index');
    }
    
}
