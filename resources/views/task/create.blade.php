@extends('layouts.app')

@section('content')
    <h1>Создать задачу</h1>

    {{ html()->modelForm($task, 'POST', route('tasks.store'))->open() }}
    @include('task.form', ['action' => 'Создать'])
    {{ html()->closeModelForm() }}
@endsection
