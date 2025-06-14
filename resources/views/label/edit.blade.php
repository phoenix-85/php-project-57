@extends('layouts.app')

@section('content')
    <h1>Изменение метки</h1>

    {{ html()->modelForm($label, 'PATCH', route('labels.update', $label))->open() }}
        @include('label.form', ['action' => 'Обновить'])
    {{ html()->closeModelForm() }}
@endsection
