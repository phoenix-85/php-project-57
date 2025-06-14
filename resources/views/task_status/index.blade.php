@extends('layouts.app')

@section('content')
    <h1>Статусы</h1>
    @can('create', \App\Models\TaskStatus::class)
        <div>
            <a href="{{ route('task_statuses.create') }}">Создать статус</a>
        </div>
    @endcan
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Дата создания</th>
            @auth
                <th>Действия</th>
            @endauth
        </tr>
        </thead>
        @foreach($taskStatuses as $taskStatus)
            <tr>
                <td>{{ $taskStatus->id }}</td>
                <td>{{ $taskStatus->name }}</td>
                <td>{{ $taskStatus->created_at }}</td>
                @auth
                    <td>
                        <form method="POST" action="{{ route('task_statuses.destroy', $taskStatus) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Удалить</button>
                        </form>
                        <a href="{{ route('task_statuses.edit', $taskStatus) }}">Изменить</a>
                    </td>
                @endauth
            </tr>
        @endforeach
    </table>
@endsection
