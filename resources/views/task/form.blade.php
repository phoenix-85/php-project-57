<div>
    {{ html()->label('Имя', 'name') }}
    {{ html()->text('name') }}
</div>

<div>
    {{ html()->label('Описание', 'description') }}
    {{ html()->textarea('description') }}
</div>

<div>
    {{ html()->label('Статус', 'status_id') }}
    {{ html()->select('status_id', $taskStatuses, $task->status?->id)->prependChild(html()->option()->selected('selected')) }}
</div>

<div>
    {{ html()->label('Исполнитель', 'assigned_to_id') }}
    {{ html()->select('assigned_to_id', $users, $task->assignedTo?->id)->prependChild(html()->option()->selected('selected')) }}
</div>

<div>
    {{ html()->label('Метки', 'labels[]') }}
    {{ html()->multiselect('labels[]', [], []) }}
</div>

<div>
    {{ html()->submit($action) }}
</div>









