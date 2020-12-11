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
    @if (session()->has('danger'))
        <x-alerts.toast wire:model="alert" color='red'>
            <x-slot name="message">{{ session('danger') }}</x-slot>
            <button type="button" wire:click="$refresh" class="text-red-700">
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
                        <x-jet-button type='button' wire:click="createQuestion">Agregar pregunta</x-jet-button>
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
                        Lectura: <span class="font-bold">{{ $reading->title }}</span>
                    </div>
                    <div class="text-gray-500 mb-2">
                        A continuación puedes obsevar el listado de preguntas que registrastes para el cuestionario.
                    </div>

                    <div class="flex items-center mb-4" >
                        <div class="flex-grow">
                            <div class="text-gray-500 mb-2">
                                @if ($questions)
                                    @if ($questionnarie->status)
                                        <span class="text-green-600"> Estado: publicado</span>
                                    @else
                                        <span class="text-red-600"> Estado: privado</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @if ($questions)
                            @if (!$questionnarie->status)
                                <button type="button" wire:click="confirmPublication" class="inline-flex ml-2 items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Publicar
                                </button>
                            @endif
                        @endif
                    </div>
                   
                    <x-tables.questions :questions="$questions"/>

                    {{-- Se presentan los modaldes acorde a la opción seleccionada por el usuario en el componente table-user --}}
                    @include("livewire.$view")
                </div>
            </div>
        </div>
    </div>
</div>