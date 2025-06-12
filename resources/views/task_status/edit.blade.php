@extends('layouts.app')

@section('content')
    <h1>Изменение статуса</h1>

    {{ html()->modelForm($taskStatus, 'PATCH', route('task_statuses.update', $taskStatus))->open() }}
        @include('task_status.form', ['action' => 'Обновить'])
    {{ html()->closeModelForm() }}
@endsection
