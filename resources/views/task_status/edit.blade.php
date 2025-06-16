@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Изменение статуса</h1>

    {{ html()->modelForm($taskStatus, 'PATCH', route('task_statuses.update', $taskStatus))->class('w-50')->open() }}
    @include('task_status.partials.form', ['action' => 'Обновить'])
    {{ html()->closeModelForm() }}
@endsection
