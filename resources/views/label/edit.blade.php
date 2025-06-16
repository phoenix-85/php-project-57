@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Изменение метки</h1>

    {{ html()->modelForm($label, 'PATCH', route('labels.update', $label))->class('w-50')->open() }}
    @include('label.partials.form', ['action' => 'Обновить'])
    {{ html()->closeModelForm() }}
@endsection
