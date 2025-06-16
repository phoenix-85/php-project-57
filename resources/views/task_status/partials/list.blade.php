<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Дата создания</th>
        @auth
            <th>Действия</th>
        @endauth
    </tr>
    </thead>
    @foreach($taskStatuses as $taskStatus)
        <tr>
            <td>{{ $taskStatus->id }}</td>
            <td>{{ $taskStatus->name }}</td>
            <td>{{ $taskStatus->created_at->format('d.m.Y') }}</td>
            @auth
                <td>
                    <form method="POST" action="{{ route('task_statuses.destroy', $taskStatus) }}">
                        @method('DELETE')
                        @csrf
                        <button
                            type="submit"
                            class="text-red-600 hover:text-red-900"
                        >
                            Удалить
                        </button>
                    </form>
                    <a
                        href="{{ route('task_statuses.edit', $taskStatus) }}"
                        class="text-blue-600 hover:text-blue-900"
                    >
                        Изменить
                    </a>
                </td>
            @endauth
        </tr>
    @endforeach
</table>
