<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::orderBy('created_at', 'desc');
        
        if ($request->has('status') && in_array($request->status, ['pending', 'done'])) {
            $query->where('status', $request->status);
        }

        $tasks = $query->paginate(10);
        
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        Task::create($validated);
        
        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();
        $task->update($validated);
        
        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete(); 
        
        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }

    /**
     * Lists all deleted tasks (Soft Deletes).
     * @return \Illuminate\View\View
     */
    public function trash()
    {
        $tasks = Task::onlyTrashed()->paginate(10);
        
        return view('tasks.trash', compact('tasks'));
    }

    /**
     * Restores a logically deleted task.
     * @param \App\Models\Task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Task $task)
    {
        $task->restore(); 
        
        return redirect()->route('tasks.index')->with('success', 'Tarefa restaurada com sucesso!');
    }
}
