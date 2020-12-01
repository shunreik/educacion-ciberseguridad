
<div>
    <x-slot name="header">
        <div class="flex items-center" >
            <h2 class="flex-grow font-semibold text-xl text-gray-800 leading-tight ">
                Módulo Profesores
            </h2>
            <x-jet-button>Agregar profesor</x-jet-button>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-2 text-2xl">
                        Listado de profesores registrados
                    </div>
                    <div class="mt-4 text-gray-500 mb-2">
                        A continuación puedes obsevar el listado de profesores registrados.
                    </div>

                    {{-- Opciones de filtrado --}}
                    <div class="flex justify-center mb-4">
                        <x-filters.status>
                            <x-buttons.filter class="active">Todos</x-buttons.filter>
                            <x-buttons.filter color="green">Activos</x-buttons.filter>
                            <x-buttons.filter color="pink">Inactivos</x-buttons.filter>
                        </x-filters.status>
                    </div>

                    <x-tables.users :users=$teachers role='profesor'/>

                    {{-- Se presentan los modaldes acorde a la opción seleccionada por el usuario en el componente table-user --}}
                    {{-- @include("livewire.student.$view") --}}

                </div>
            </div>
        </div>
    </div>
</div>
