@extends('layouts.app')

@section('content')
    <div>
        <p>Имя: {{ $task->name }}</p>
        <p>Описание: {{ $task->description }}</p>
        <p>Статус: {{ $task->status->name }}</p>
        <p>Исполнитель: {{ $task->assignedTo->name }}</p>
        <p>Метки: </p>
        @foreach($task->labels as $label)
            <div>
                {{ $label->name }}
            </div>
        @endforeach
    </div>
@endsection
