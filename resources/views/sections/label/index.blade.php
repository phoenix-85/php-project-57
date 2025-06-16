@use('App\Models\Label')
@extends('layouts.app')

@section('content')
    <div>
        <h1 class="mb-5">{{ __('Labels') }}</h1>
    </div>
    @can('create', Label::class)
        <div>
            <a
                href="{{ route('labels.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                {{ __('Create label') }}
            </a>
        </div>
    @endcan
    @include('sections.label.partials.list')
@endsection
