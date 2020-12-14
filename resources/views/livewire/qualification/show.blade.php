<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center mb-4" >
            <div class="flex-grow">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Calificación
                </h2>
            </div>
            <a href="{{route('qualifications')}}" class="inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Regresar</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-2 text-2xl">
                        Lectura: <span class="text-gray-600">{{  $score->questionnarie->reading->title }}</span>
                    </div>
                    
                    <div class="mt-4 text-gray-500 mb-2 text-right">
                         Calificación: {{ $score->qualification }}/10
                    </div>

                    @foreach ($questions as $question)
                    <div class="md:col-span-1 mb-4">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                <span class="text-gray-600 ">Pregunta {{ $loop->iteration }}:</span> {{ $question->content }}
                            </h3>
                            
                            {{-- Se recorre las respuestas del usuario --}}
                            @foreach ($studentResponses as $studentResponse)
                                @if ($question->answer->id === $studentResponse->uuid_response)
                                    <div class="inline-flex">
                                        <p class="mt-1 text-md text-gray-600 mx-5 mb-1">
                                            Respuesta: {{ $question->answer->content }}
                                        </p>
                                        <x-icons.correct class="w-7 h-7 fill-current mx-2"/>
                                    </div>
                                    @break
                                @else
                                    @foreach ($question->options as $option)
                                        @if ($option->id === $studentResponse->uuid_response)
                                        <div class="inline-flex">
                                            <p class="mt-1 text-md text-gray-600 mx-5 mb-1">
                                                Respuesta: {{ $option-> content }}
                                            </p>
                                            <x-icons.wrong class="w-7 h-7 fill-current mx-2"/>
                                        </div>
                                        <p class="mt-1 text-md text-gray-600 text-justify mx-5">
                                            La respuesta correcta es: {{ $question->answer->content }}
                                        </p>
                                            @break
                                        @endif
                                    @endforeach
                                @endif

                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>