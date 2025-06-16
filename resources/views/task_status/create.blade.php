@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Создать статус</h1>

    {{ html()->modelForm($taskStatus, 'POST', route('task_statuses.store'))->class('w-50')->open() }}
    @include('task_status.partials.form', ['action' => 'Создать'])
    {{ html()->closeModelForm() }}
@endsection
