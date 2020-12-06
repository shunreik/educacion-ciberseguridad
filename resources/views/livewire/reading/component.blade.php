<div>
    @slot('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Módulo Lectura
    </h2>
    @endslot
    @if (session()->has('success'))
        <x-alerts.toast wire:model="alert">
            <x-slot name="message">{{ session('success') }}</x-slot>
            <button type="button" wire:click="$refresh" class="text-green-700">
                <span class="">&times;</span>
            </button>
        </x-alerts.toast>
    @endif


    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-2 text-2xl">
                        Registrar lectura
                    </div>
                    <div class="flex items-center" >
                        <div class="flex-grow mt-4 text-gray-500 mb-2">
                            Puedes agregar una nueva lectura seleccionando la siguiente opción.
                        </div>
                        {{-- <x-jet-button type='button' wire:click='create' wire:loading.attr="disabled">Agregar lectura</x-jet-button> --}}
                        <x-jet-button type='button' wire:click="create">Agregar lectura</x-jet-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-2 text-2xl">
                        Listado de tus lecturas registradas
                    </div>
                    <div class="mt-4 text-gray-500 mb-2">
                        A continuación puedes obsevar el listado de lecturas que registrastes.
                    </div>

                    {{-- Opciones de filtrado --}}
                    {{-- <div class="flex justify-center mb-4">
                        <x-filters.status>
                            <x-buttons.filter class="{{$all ? 'active' : ''}}" wire:click='allUsers'>Todos</x-buttons.filter>
                            <x-buttons.filter color='green' class="{{$actived ? 'active' : ''}}" wire:click='activatedUsers'>Activos</x-buttons.filter>
                            <x-buttons.filter color='pink' class="{{$disabled ? 'active' : ''}}" wire:click="disabledUsers">Inactivos</x-buttons.filter>
                        </x-filters.status>
                    </div> --}}
                   
                    <x-tables.reading :data="$readings"/>

                    {{-- Se presentan los modaldes acorde a la opción seleccionada por el usuario en el componente table-user --}}
                    {{-- @include("livewire.reading.$view") --}}

                </div>
            </div>
        </div>
    </div>
</div>
