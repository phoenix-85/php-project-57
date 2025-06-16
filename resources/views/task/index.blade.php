@use('App\Models\Task')
@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Задачи</h1>
    @can('create', Task::class)
        <div>
            <a
                href="{{ route('tasks.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Создать задачу
            </a>
        </div>
    @endcan
    @includeIf('task.partials.filter')
    @include('task.partials.list')
    {{ $tasks->links() }}
@endsection
