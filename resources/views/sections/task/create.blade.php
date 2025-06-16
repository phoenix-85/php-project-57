@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('Create task') }}</h1>

    {{ html()->modelForm($task, 'POST', route('tasks.store'))->class('w-50')->open() }}
    @include('sections.task.partials.form', ['action' => __('Create')])
    {{ html()->closeModelForm() }}
@endsection
