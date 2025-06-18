<table class="mt-4">
    <thead class="border-b-2 border-solid border-black text-left">
    <tr>
        <th>ID</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Description') }}</th>
        <th>{{ __('Date of creation') }}</th>
        @auth
            <th>{{ __('Actions') }}</th>
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
                    <a
                        href="{{ route('labels.destroy', $label) }}"
                        onclick="event.preventDefault(); window.confirmDeleteLabel.showModal()"
                        class="text-red-600 hover:text-red-900"
                    >
                        {{__('Delete')}}
                    </a>
                    <dialog id="confirmDeleteLabel" class="py-4 px-4 rounded shadow-sm">
                        <h2 class="font-semibold">Удаление "{{ $label->name }}"</h2>
                        <p class="mt-1">Вы действительно хотите удалить метку?</p>
                        <div class="flex justify-center mt-4">
{{--                            <x-secondary-button--}}
{{--                                onclick="window.confirmDeleteLabel.close()"--}}
{{--                            >--}}
{{--                                {{ __('Cancel') }}--}}
{{--                            </x-secondary-button>--}}
                            <form method="POST" action="{{ route('labels.destroy', $label) }}">
                                @method('DELETE')
                                @csrf
                                <x-primary-button class="ms-3">
                                    {{ __('OK') }}
                                </x-primary-button>
                            </form>
                        </div>
                    </dialog>
                    <a
                        href="{{ route('labels.edit', $label) }}"
                        class="text-blue-600 hover:text-blue-900"
                    >
                        {{ __('Edit') }}
                    </a>
                </td>
            @endauth
        </tr>
    @endforeach
</table>
