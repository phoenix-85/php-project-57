@use('App\Models\Label')
@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Метки</h1>
    @can('create', Label::class)
        <div>
            <a
                href="{{ route('labels.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Создать метку
            </a>
        </div>
    @endcan
    @include('label.partials.list')
@endsection
