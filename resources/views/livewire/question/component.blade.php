<div>
    @slot('header')
    <div class="flex items-center mb-4" >
        <div class="flex-grow">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contenido del cuestionario
            </h2>
        </div>
        <a href="{{route('questionnarie')}}" class="inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Regresar</a>
    </div>

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
                        Registrar pregunta
                    </div>
                    <div class="flex items-center" >
                        <div class="flex-grow mt-4 text-gray-500 mb-2">
                            Puedes agregar una nueva pregunta seleccionando la siguiente opción.
                        </div>
                        <x-jet-button type='button'>Agregar pregunta</x-jet-button>
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
                        Listado de tus preguntas registradas
                    </div>
                    <div class="mt-4 text-gray-500">
                        Lectura: <span class="font-bold">{{ $title }}</span>
                    </div>
                    <div class="text-gray-500 mb-2">
                        A continuación puedes obsevar el listado de preguntas que registrastes para el cuestionario.
                    </div>
                   
                    <x-tables.questions :questionnarie="$questionnarie"/>

                    {{-- Se presentan los modaldes acorde a la opción seleccionada por el usuario en el componente table-user --}}
                    {{-- @include("livewire.reading.$view") --}}
                </div>
            </div>
        </div>
    </div>
</div>