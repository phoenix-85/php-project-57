<div>
    {{ html()->form('GET', route('tasks.index'))->open() }}
    <div class="flex">
        {{ html()->select('filter[status_id]', $statuses, $inputFilter['status_id'] ?? null)->placeholder('Статус') }}
        {{ html()->select('filter[created_by_id]', $users, $inputFilter['created_by_id'] ?? null)->placeholder('Автор') }}
        {{ html()->select('filter[assigned_to_id]', $users, $inputFilter['assigned_to_id'] ?? null)->placeholder('Исполнитель') }}
        {{ html()->submit('Применить') }}
        {{ html()->form()->close() }}
    </div>

</div>
