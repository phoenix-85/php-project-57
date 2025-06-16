@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('Create label') }}</h1>

    {{ html()->modelForm($label, 'POST', route('labels.store'))->class('w-50')->open() }}
    @include('sections.label.partials.form', ['action' => __('Create')])
    {{ html()->closeModelForm() }}
@endsection
