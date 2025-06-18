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
                        onclick="
                            event.preventDefault();
                            result = confirm('Вы действительно хотите удалить метку?');
                            if (result) {
                                form = document.getElementById('deleteForm');
                                form.action = '{{ route('labels.destroy', $label) }}';
                                form.submit();
                            }"
                        class="text-red-600 hover:text-red-900"
                    >
                        {{ __('Delete') }}
                    </a>
                    <a
                        href="{{ route('labels.edit', $label) }}"
                        class="text-blue-600 hover:text-blue-900"
                    >
                        {{ __('Edit') }}
                    </a>
                    <form id="deleteForm" method="POST" action="{{ route('labels.destroy', $label) }}">
                        @method('DELETE')
                        @csrf
                    </form>
                </td>
            @endauth
        </tr>
    @endforeach
</table>
