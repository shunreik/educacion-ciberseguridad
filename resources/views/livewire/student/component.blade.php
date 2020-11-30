<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Módulo estudiantes
        </h2>
    </x-slot>
    <div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mt-2 text-2xl">
                            Listado de estudiantes registrados
                        </div>

                        <div class="mt-4 text-gray-500">
                            A continuación puedes obsevar el listado de estudiantes registrados.
                        </div>

                        <x-table.users :users=$students role='estudiante'/>

                        {{-- Se presentan los modaldes acorde a la opción seleccionada por el usuario en el componente table-user --}}
                        @include("livewire.student.$view")

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>