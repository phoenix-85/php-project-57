<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskStatusController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', TaskStatus::class);
        $taskStatuses = TaskStatus::all();
        return view('task_status.index', compact('taskStatuses'));
    }

    public function create()
    {
        $this->authorize('create', TaskStatus::class);
        $taskStatus = TaskStatus::make();
        return view('task_status.create', compact('taskStatus'));
    }

    public function edit(TaskStatus $taskStatus)
    {
        $this->authorize('update', $taskStatus);
        return view('task_status.edit', compact('taskStatus'));
    }

    public function store(TaskStatusRequest $request)
    {
        $this->authorize('create', TaskStatus::class);
        TaskStatus::create($request->validated());
        return to_route('task_statuses.index')->with('status', 'Статус успешно создан');
    }

    public function update(TaskStatusRequest $request, TaskStatus $taskStatus)
    {
        $this->authorize('update', $taskStatus);
        $taskStatus->update($request->validated());
        return to_route('task_statuses.index')->with('status', 'Статус успешно обновлен');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        $this->authorize('delete', $taskStatus);
        $status = $taskStatus->delete() ? 'Статус успешно удален' : 'Не удалось удалить статус';
        return to_route('task_statuses.index')->with('status', $status);
    }
}
