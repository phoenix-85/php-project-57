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
                    <a
                        href="{{ route('task_statuses.destroy', $taskStatus) }}"
                        onclick="event.preventDefault(); window.confirmDeleteStatus.showModal()"
                        class="text-red-600 hover:text-red-900"
                    >
                        {{__('Delete')}}
                    </a>
                    <dialog id="confirmDeleteStatus" class="py-4 px-4 rounded shadow-sm">
                        <h2 class="font-semibold">Удаление "{{ $taskStatus->name }}"</h2>
                        <p class="mt-1">Вы действительно хотите удалить статус?</p>
                        <div class="flex justify-center mt-4">
{{--                            <x-secondary-button--}}
{{--                                onclick="window.confirmDeleteStatus.close()"--}}
{{--                            >--}}
{{--                                {{ __('Cancel') }}--}}
{{--                            </x-secondary-button>--}}
                            <form method="POST" action="{{ route('task_statuses.destroy', $taskStatus) }}">
                                @method('DELETE')
                                @csrf
                                <x-primary-button class="ms-3">
                                    {{ __('OK') }}
                                </x-primary-button>
                            </form>
                        </div>
                    </dialog>
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
