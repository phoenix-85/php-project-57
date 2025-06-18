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
                        <a
                            href="{{ route('tasks.destroy', $task) }}"
                            onclick="event.preventDefault(); window.confirmDelete.showModal()"
                            class="text-red-600 hover:text-red-900"
                        >
                            {{__('Delete')}}
                        </a>
                        <dialog id="confirmDelete" class="py-4 px-4 rounded shadow-sm" role="alertdialog">
                            <h2 class="font-semibold">Удаление "{{ $task->name }}"</h2>
                            <p class="mt-1">Вы действительно хотите удалить задачу?</p>
                            <div class="flex justify-center mt-4">
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                    @method('DELETE')
                                    @csrf
                                    <x-secondary-button
                                        onclick="window.confirmDelete.close()"
                                    >
                                        {{ __('Cancel') }}
                                    </x-secondary-button>
                                    <x-primary-button class="ms-3" value="confirm">
                                        {{ __('OK') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </dialog>
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
