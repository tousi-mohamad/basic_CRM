<x-superAdmin-layout>

    <x-slot name="header">

    </x-slot>

    <div class="py-12">

        <livewire:admin.organisations />

    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('nav', () => ({
                active: 'organization',

            }))
        })
    </script>
</x-superAdmin-layout>
