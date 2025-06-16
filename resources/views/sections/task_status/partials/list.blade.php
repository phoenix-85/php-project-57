<table class="mt-4">
    <thead class="border-b-2 border-solid border-black text-left">
    <tr>
        <th>ID</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Date of creation') }}</th>
        @auth
            <th>{{ __('Actions') }}</th>
        @endauth
    </tr>
    </thead>
    @foreach($taskStatuses as $taskStatus)
        <tr class="border-b border-dashed text-left">
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
                            {{ __('Delete') }}
                        </button>
                    </form>
                    <a
                        href="{{ route('task_statuses.edit', $taskStatus) }}"
                        class="text-blue-600 hover:text-blue-900"
                    >
                        {{ __('Edit') }}
                    </a>
                </td>
            @endauth
        </tr>
    @endforeach
</table>
