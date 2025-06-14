@extends('layouts.app')

@section('content')
    <h1>Изменение задачи</h1>

    {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task))->open() }}
    @include('task.form', ['action' => 'Обновить'])
    {{ html()->closeModelForm() }}
@endsection
