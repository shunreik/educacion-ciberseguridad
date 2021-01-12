<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center mb-4" >
            <div class="flex-grow">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Cuestionario
                </h2>
            </div>
            <a href="{{ route('content.reading', $questionnarie->reading->id ) }}" class="inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Regresar</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-2 text-2xl">
                        Lectura: <span class="text-gray-700">{{ $questionnarie->reading->title }}</span>
                    </div>

                    <div class="mt-4 text-gray-500 mb-3">
                        Este cuestionario te permite averiguar cuanto has aprendido. 

                        Selecciona unicamente una opción por pregunta y asegúrate de responderlas todas.
                    </div>

                    {{-- Cuestionario --}}

                    <form action="{{ route('store.questionnarie', $questionnarie->id) }}" method="POST">
                        @csrf
                         
                         @foreach ($questionnarieForm as $item => $value)
                             {{-- {{ var_dump($value) }} --}}
                             <div class="col-span-6 sm:col-span-5 mb-4">
                                <x-jet-label value="Pregunta {{ $item + 1 }}: {{ $value['question']->content }}" />
                                    @foreach ($value['options'] as $option)
                                    {{-- @php
                                        $inputName = "answer_$item";
                                    @endphp --}}
                                    <div class="my-2 ml-5">
                                        <input type="radio" id="{{ $option->id }}" name="{{$value['question']->id }}" value="{{$option->id}}" {{ old($value['question']->id) === "$option->id" ? "checked" : "" }}>
                                        <label for="{{ $option->id }}">{{ $option->content }}</label>
                                    </div>
                                    @endforeach
                                <x-jet-input-error for="{{$value['question']->id }}" class="mt-2"/>
                            </div>
                         @endforeach

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <x-jet-button type='submit'>
                                Enviar
                            </x-jet-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>