@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Создать задачу</h1>

    {{ html()->modelForm($task, 'POST', route('tasks.store'))->class('w-50')->open() }}
    @include('task.partials.form', ['action' => 'Создать'])
    {{ html()->closeModelForm() }}
@endsection
