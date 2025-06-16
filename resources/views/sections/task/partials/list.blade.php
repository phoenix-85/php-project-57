<table class="mt-4">
    <thead class="border-b-2 border-solid border-black text-left">
    <tr>
        <th>ID</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Author') }}</th>
        <th>{{ __('Executor') }}</th>
        <th>{{ __('Date of creation') }}</th>
        @auth
            <th>{{ __('Actions') }}</th>
        @endauth
    </tr>
    </thead>
    @foreach($tasks as $task)
        <tr class="border-b border-dashed text-left">
            <td>{{ $task->id }}</td>
            <td>{{ $task->status->name }}</td>
            <td>
                <a
                    href="{{ route('tasks.show', $task) }}"
                    class="text-blue-600 hover:text-blue-900"
                >
                    {{ $task->name }}
                </a>
            </td>
            <td>{{ $task->createdBy->name }}</td>
            <td>{{ $task->assignedTo->name }}</td>
            <td>{{ $task->created_at->format('d.m.Y') }}</td>
            @auth
                <td>
                    @can('delete', $task)
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                            @method('DELETE')
                            @csrf
                            <button
                                type="submit"
                                class="text-red-600 hover:text-red-900"
                            >
                                {{ __('Delete') }}
                            </button>
                        </form>
                    @endcan
                    <a
                        href="{{ route('tasks.edit', $task) }}"
                        class="text-blue-600 hover:text-blue-900"
                    >
                        {{ __('Edit') }}
                    </a>
                </td>
            @endauth
        </tr>
    @endforeach
</table>
