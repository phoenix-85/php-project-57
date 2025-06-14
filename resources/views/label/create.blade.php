@extends('layouts.app')

@section('content')
    <h1>Создать метку</h1>

    {{ html()->modelForm($label, 'POST', route('labels.store'))->open() }}
        @include('label.form', ['action' => 'Создать'])
    {{ html()->closeModelForm() }}
@endsection
