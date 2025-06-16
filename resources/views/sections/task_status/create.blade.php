@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('Create status') }}</h1>

    {{ html()->modelForm($taskStatus, 'POST', route('task_statuses.store'))->class('w-50')->open() }}
    @include('sections.task_status.partials.form', ['action' => __('Create')])
    {{ html()->closeModelForm() }}
@endsection
