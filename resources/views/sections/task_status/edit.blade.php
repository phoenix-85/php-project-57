@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('Edit status') }}</h1>

    {{ html()->modelForm($taskStatus, 'PATCH', route('task_statuses.update', $taskStatus))->class('w-50')->open() }}
    @include('sections.task_status.partials.form', ['action' => 'Обновить'])
    {{ html()->closeModelForm() }}
@endsection
