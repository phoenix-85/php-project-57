@use('App\Models\TaskStatus')
@extends('layouts.app')

@section('content')
    <div>
        <h1>{{ __('Statuses') }}</h1>
    </div>
    @can('create', TaskStatus::class)
        <div>
            <a
                href="{{ route('task_statuses.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                {{ __('Create status') }}
            </a>
        </div>
    @endcan
    @include('sections.task_status.partials.list')
@endsection
