<div class="flex flex-col">
    <div class="mt-2">
        {{ html()->label('Имя', 'name') }}
    </div>
    <div>
        {{ html()->text('name')->class(['rounded', 'border-gray-300', 'w-1/3']) }}
    </div>

    <div class="mt-2">
        {{ html()->label('Описание', 'description') }}
    </div>
    <div>
        {{ html()->textarea('description')->class(['rounded', 'border-gray-300', 'w-1/3', 'h-32']) }}
    </div>

    <div class="mt-2">
        <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2"
        >
            {{ $action }}
        </button>
    </div>
</div>





