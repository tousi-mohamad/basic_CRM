<div class="w-full grid grid-col-2">
    <h4 class="mb-4">Add Permission</h4>

    <form wire:submit.prevent="add_permission()" >

        <input
            class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            type="text" wire:model.debounce.500ms="name">

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Add</button>
        <br>
        @error('name') <span class="error text-red-600" >{{ $message }}</span> @enderror
    </form>
</div>
