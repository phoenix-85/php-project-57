@use('App\Models\TaskStatus')
@extends('layouts.app')

@section('content')
    <h1>Статусы</h1>
    @can('create', TaskStatus::class)
        <div>
            <a
                href="{{ route('task_statuses.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Создать статус
            </a>
        </div>
    @endcan
    @include('task_status.partials.list')
@endsection
