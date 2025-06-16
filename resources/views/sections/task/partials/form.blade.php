<div class="flex flex-col">
    <div class="mt-2">
        {{ html()->label(__('Name'), 'name') }}
    </div>
    <div>
        {{ html()->text('name')->class(['rounded', 'border-gray-300', 'w-1/3']) }}
    </div>
    <div class="mt-2">
        {{ html()->label(__('Description'), 'description') }}
    </div>
    <div>
        {{ html()->textarea('description')->class(['rounded', 'border-gray-300', 'w-1/3', 'h-32']) }}
    </div>
    <div class="mt-2">
        {{ html()->label(__('Status'), 'status_id') }}
    </div>
    <div>
        {{ html()->select('status_id', $taskStatuses, $task->status?->id)->class(['rounded', 'border-gray-300', 'w-1/3'])->placeholder('') }}
    </div>
    <div class="mt-2">
        {{ html()->label(__('Executor'), 'assigned_to_id') }}
    </div>
    <div>
        {{ html()->select('assigned_to_id', $users, $task->assignedTo?->id)->class(['rounded', 'border-gray-300', 'w-1/3'])->placeholder('') }}
    </div>
    <div class="mt-2">
        {{ html()->label(__('Labels'), 'labels') }}
    </div>
    <div>
        {{ html()->multiselect('labels', $labels)->class(['rounded', 'border-gray-300', 'w-1/3', 'h-32']) }}
    </div>

    <div>
        <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2"
        >
            {{ $action }}
        </button>
    </div>
</div>










