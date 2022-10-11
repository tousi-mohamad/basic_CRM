<x-superAdmin-layout>

    <x-slot name="header">
        <style>
            span[aria-current="page"] span {
                color: red !important;
                font-weight: bolder !important;
            }
        </style>
    </x-slot>

    <div class="py-12">

        <livewire:role.add />

        <br>

        <livewire:role.roles />

    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('nav', () => ({
                active: 'role',

            }))
        })
    </script>
</x-superAdmin-layout>
