@extends('layouts.app')

@section('content')
    <h1>Создать статус</h1>

    {{ html()->modelForm($taskStatus, 'POST', route('task_statuses.store'))->open() }}
        @include('task_status.form', ['action' => 'Создать'])
    {{ html()->closeModelForm() }}
@endsection
