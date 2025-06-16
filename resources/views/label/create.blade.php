@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Создать метку</h1>

    {{ html()->modelForm($label, 'POST', route('labels.store'))->class('w-50')->open() }}
    @include('label.partials.form', ['action' => 'Создать'])
    {{ html()->closeModelForm() }}
@endsection
