<table class="mt-4">
    <thead class="border-b-2 border-solid border-black text-left">
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
        <tr class="border-b border-dashed text-left">
            <td>{{ $label->id }}</td>
            <td>{{ $label->name }}</td>
            <td>{{ $label->description }}</td>
            <td>{{ $label->created_at->format('d.m.Y') }}</td>
            @auth
                <td>
                    <form method="POST" action="{{ route('labels.destroy', $label) }}">
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
                        href="{{ route('labels.edit', $label) }}"
                        class="text-blue-600 hover:text-blue-900"
                    >
                        Изменить
                    </a>
                </td>
            @endauth
        </tr>
    @endforeach
</table>
