<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            Módulo Profesor
        </h2>
    </x-slot>
    
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
                        Registrar profesor
                    </div>
                    <div class="flex items-center" >
                        <div class="flex-grow mt-4 text-gray-500 mb-2">
                            Puedes agregar a un nuevo profesor seleccionando la siguiente opción.
                        </div>
                        <x-jet-button type='button' wire:click='create' wire:loading.attr="disabled">Agregar profesor</x-jet-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="grid lg:grid-cols-2 gap-1">
                        <div class="mt-2 text-2xl">
                            Listado de profesores registrados
                        </div>

                        <div class="box my-4 lg:my-0">
                            <div class="box-wrapper">
                                <div class=" bg-white rounded-full flex items-center w-full p-3 shadow-sm border border-gray-200">
                                  <div  class="outline-none focus:outline-none"><svg class=" w-5 text-gray-600 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></div>
                                  <input type="search" name="" id="" wire:model="search" placeholder="Buscar profesor" class="w-full pl-4 text-sm outline-none focus:outline-none bg-transparent">
                                  
                                  <div class="select">
                                    <select name="" id="" wire:model="typeSearch" class="text-sm outline-none focus:outline-none bg-transparent mx-2">
                                      <option value="surname" selected>Apellido</option>
                                      <option value="name">Nombre</option>
                                      <option value="nickname">Usuario</option>
                                     </select>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-gray-500 mb-2">
                        A continuación puedes obsevar el listado de profesores registrados.
                    </div>

                    {{-- Opciones de filtrado --}}
                    <div class="flex justify-center mb-4">
                        <x-filters.status>
                            <x-buttons.filter class="{{$all ? 'active' : ''}}" wire:click='allUsers'>Todos</x-buttons.filter>
                            <x-buttons.filter color='green' class="{{$actived ? 'active' : ''}}" wire:click='activatedUsers'>Activos</x-buttons.filter>
                            <x-buttons.filter color='pink' class="{{$disabled ? 'active' : ''}}" wire:click="disabledUsers">Inactivos</x-buttons.filter>
                        </x-filters.status>
                    </div>
                   
                    <x-tables.users :users=$teachers role='profesor'/>

                    {{-- Se presentan los modaldes acorde a la opción seleccionada por el usuario en el componente table-user --}}
                    @include("livewire.teacher.$view")

                </div>
            </div>
        </div>
    </div>
</div>
