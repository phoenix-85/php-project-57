<div class="w-full flex items-center">
    {{ html()->form('GET', route('tasks.index'))->open() }}
    <div class="flex">
        {{ html()->select('filter[status_id]', $statuses, $filter['status_id'] ?? null)->class(['rounded', 'border-gray-300'])->placeholder('Статус') }}
        {{ html()->select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null)->class(['rounded', 'border-gray-300'])->placeholder('Автор') }}
        {{ html()->select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null)->class(['rounded', 'border-gray-300'])->placeholder('Исполнитель') }}
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Применить</button>
        {{ html()->form()->close() }}
    </div>
</div>
