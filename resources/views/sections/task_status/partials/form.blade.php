<div class="flex flex-col">


    <!-- Name -->
    <div class="mt-2">
        {{ html()->label(__('Name'), 'name') }}
    </div>
    <div>
        {{ html()->text('name')->class(['rounded', 'border-gray-300', 'w-1/3']) }}
    </div>
    @error('name')
    <div class="text-red-600">
        {{ $message }}
    </div>
    @enderror

    <!-- Submit -->
    <div class="mt-2">
        <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2"
        >
            {{ $action }}
        </button>
    </div>
</div>





