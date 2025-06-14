@extends('layouts.app')

@section('content')
    <h1>Статусы</h1>
    @can('create', \App\Models\Task::class)
        <div>
            <a href="{{ route('tasks.create') }}">Создать задачу</a>
        </div>
    @endcan
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Статус</th>
            <th>Имя</th>
            <th>Автор</th>
            <th>Исполнитель</th>
            <th>Дата создания</th>
            @auth
                <th>Действия</th>
            @endauth
        </tr>
        </thead>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->status->name }}</td>
                <td>
                    <a href="{{ route('tasks.show', $task) }}">
                        {{ $task->name }}
                    </a>
                </td>
                <td>{{ $task->createdBy->name }}</td>
                <td>{{ $task->assignedTo->name }}</td>
                <td>{{ $task->created_at }}</td>
                @auth
                    <td>
                        @can('delete', $task)
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit">Удалить</button>
                            </form>
                        @endcan
                        <a href="{{ route('tasks.edit', $task) }}">Изменить</a>
                    </td>
                @endauth
            </tr>
        @endforeach
    </table>
@endsection
