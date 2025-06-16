@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Изменение задачи</h1>

    {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task))->class('w-50')->open() }}
    @include('task.partials.form', ['action' => 'Обновить'])
    {{ html()->closeModelForm() }}
@endsection
