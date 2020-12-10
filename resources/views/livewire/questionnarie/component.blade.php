<div>
    @slot('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Módulo Cuestionario
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-2 text-2xl">
                        Cuestionarios registrados
                    </div>
                    <div class="mt-4 text-gray-500 mb-2">
                        A continuación puedes agregar o editar el cuestionario en cada una de tus lecturas.
                    </div>

                    {{-- Opciones de filtrado --}}
                    {{-- <div class="flex justify-center mb-4">
                        <x-filters.status>
                            <x-buttons.filter class="{{$all ? 'active' : ''}}" wire:click='allUsers'>Todos</x-buttons.filter>
                            <x-buttons.filter color='green' class="{{$actived ? 'active' : ''}}" wire:click='activatedUsers'>Activos</x-buttons.filter>
                            <x-buttons.filter color='pink' class="{{$disabled ? 'active' : ''}}" wire:click="disabledUsers">Inactivos</x-buttons.filter>
                        </x-filters.status>
                    </div> --}}
                   
                    <x-tables.questionnaries :data="$readings"/>

                    {{-- Se presentan los modaldes acorde a la opción seleccionada por el usuario en el componente table-user --}}
                    {{-- @include("livewire.reading.$view") --}}
                </div>
            </div>
        </div>
    </div>
</div>
