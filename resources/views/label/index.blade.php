@extends('layouts.app')

@section('content')
    <h1>Статусы</h1>
    @can('create', \App\Models\Label::class)
        <div>
            <a href="{{ route('labels.create') }}">Создать метку</a>
        </div>
    @endcan
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Описание</th>
            <th>Дата создания</th>
            @auth
                <th>Действия</th>
            @endauth
        </tr>
        </thead>
        @foreach($labels as $label)
            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>{{ $label->description }}</td>
                <td>{{ $label->created_at }}</td>
                @auth
                    <td>
                        <form method="POST" action="{{ route('labels.destroy', $label) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Удалить</button>
                        </form>
                        <a href="{{ route('labels.edit', $label) }}">Изменить</a>
                    </td>
                @endauth
            </tr>
        @endforeach
    </table>
@endsection
