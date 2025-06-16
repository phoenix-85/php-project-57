@use('App\Models\Task')
@extends('layouts.app')

@section('content')
    <div>
        <h1 class="mb-5">{{ __('Tasks') }}</h1>
    </div>
    <div class="w-full flex items-center">
        @include('sections.task.partials.filter')
        @can('create', Task::class)
            <div class="ml-auto">
                <a
                    href="{{ route('tasks.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    {{ __('Create task') }}
                </a>
            </div>
        @endcan
    </div>
    @include('sections.task.partials.list')
    {{ $tasks->links() }}
@endsection
