<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny',Task::class);
        $tasks = Task::all();
        return view('task.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('task.show', compact('task'));
    }

    public function create()
    {
        $this->authorize('create',Task::class);
        $task = Task::make();
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        return view('task.create', compact('task',  'taskStatuses', 'users', 'labels'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        return view('task.edit', compact('task', 'taskStatuses', 'users', 'labels'));
    }
    public function store(TaskRequest $request)
    {
        $this->authorize('create', Task::class);
        $task = Task::make($request->validated());
        $task->created_by_id = $request->user()->id;
        $task->assigned_to_id = $task->assigned_to_id ?? $request->user()->id;
        $task->save();
        $task->labels()->saveMany(Label::findMany($request->labels));
        return to_route('tasks.index')->with('status', 'Задача успешно создана');
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());
        $task->labels()->sync($request->labels);
        return to_route('tasks.index')->with('status', 'Задача успешно обновлена');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return to_route('tasks.index')->with('status', 'Задача успешно удалена');
    }
}
