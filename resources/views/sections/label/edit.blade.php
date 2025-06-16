@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('Edit label') }}</h1>

    {{ html()->modelForm($label, 'PATCH', route('labels.update', $label))->class('w-50')->open() }}
    @include('sections.label.partials.form', ['action' => 'Обновить'])
    {{ html()->closeModelForm() }}
@endsection
