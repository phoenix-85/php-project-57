@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('Edit task') }}</h1>

    {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task))->class('w-50')->open() }}
    @include('sections.task.partials.form', ['action' => 'Обновить'])
    {{ html()->closeModelForm() }}
@endsection
