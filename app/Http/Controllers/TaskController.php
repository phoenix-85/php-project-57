<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Task::class);
        $filter = $request->input('filter') ?? [];
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id')
            ])
            ->paginate()
            ->appends(request()->query());
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        return view('sections.task.index', compact('filter', 'tasks', 'statuses', 'users'));
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('sections.task.show', compact('task'));
    }

    public function create()
    {
        $this->authorize('create', Task::class);
        $task = new Task();
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        return view('sections.task.create', compact('task', 'taskStatuses', 'users', 'labels'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        return view('sections.task.edit', compact('task', 'taskStatuses', 'users', 'labels'));
    }
    public function store(TaskRequest $request)
    {
        $this->authorize('create', Task::class);
        $task = new Task();
        $task->fill($request->validated());
        $task->created_by_id = $request->user()->id;
        $task->assigned_to_id = $task->assigned_to_id ?? $request->user()->id;
        $task->save();
        $task->labels()->sync($request->labels);
        return to_route('tasks.index')->with('message', 'Задача успешно создана');
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());
        $task->labels()->sync($request->labels);
        return to_route('tasks.index')->with('message', 'Задача успешно изменена');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return to_route('tasks.index')->with('message', 'Задача успешно удалена');
    }
}
