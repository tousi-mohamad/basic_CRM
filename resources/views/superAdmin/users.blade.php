<x-superAdmin-layout>

    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <h1 class="font-bold text-3xl mb-4">Users</h1>

        <livewire:admin.users />

    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('nav', () => ({
                active: 'user',

            }))
        })
    </script>
</x-superAdmin-layout>
