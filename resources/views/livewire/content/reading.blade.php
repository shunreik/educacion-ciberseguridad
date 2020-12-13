<div>
    <x-slot name="header">

        <div class="flex items-center mb-4" >
            <div class="flex-grow">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Lectura
                </h2>
            </div>
            <a href="{{ route('content.topic', $readingTopicId) }}" class="inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Regresar</a>
        </div>

    </x-slot>
    
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    
                    <div class="md:col-span-1 mb-4">
                        <div class="mt-2 text-2xl">
                            {{ $readingTitle }}
                        </div>
                    </div>
                    <div class="md:col-span-1 mb-4">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900">Descripción</h3>
                            <p class="mt-1 text-md text-gray-600 text-justify">
                                {{ $readingDescription }}
                            </p>
                        </div>
                    </div>
    
                    <div class="flex justify-between items-center mt-4">
                    </div>

                    <div class="grid grid-cols-6 gap-6 mb-4">
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-section-title>
                                <x-slot name='title'>Autor/a</x-slot>
                                <x-slot name='description'>
                                    <div class="flex items-center">
                                        <img src="{{ $readingAutorPhoto }}"
                                                class="w-8 h-8 object-cover rounded-full" alt="avatar">
                                        <span class="text-gray-700 text-sm mx-3">{{ $readingAutorName }}</span>
                                    </div>
                                </x-slot>
                            </x-jet-section-title>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-section-title>
                                <x-slot name='title'>Fecha de publicación: </x-slot>
                                <x-slot name='description'>{{ $readingDate }}</x-slot>
                            </x-jet-section-title>
                        </div>
                    </div>

                    <div class="grid grid-cols-6 gap-6 mb-4">
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-section-title>
                                <x-slot name='title'>Temática</x-slot>
                                <x-slot name='description'>{{ $readingTopicName }}</x-slot>
                            </x-jet-section-title>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-section-title>
                                <x-slot name='title'>Nivel</x-slot>
                                <x-slot name='description'>{{ $readingLevel }}</x-slot>
                            </x-jet-section-title>
                        </div>
                    </div>
    
                    <div class="md:col-span-1 mb-4">
                        <x-jet-section-title>
                            <x-slot name='title'>Imágenes</x-slot>
                            <x-slot name='description'>Imágenes adjuntadas</x-slot>
                        </x-jet-section-title>
    
                        @if (count($readingImages) > 0)
    
                        <div class="h-full overflow-auto p-8 w-full flex flex-col">
                            <ul id="gallery" class="flex flex-1 flex-wrap mt-2">
                                @foreach ($readingImages as $image)
                                {{-- <template id="image-template"> --}}
                                <li class="block p-1 w-1/2 h-60">
                                    <article tabindex="0" class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                                        <a href="{{$image->getPathImage()}}" target="_blank" class="">
                                            <img alt="upload preview" class="w-full h-full  object-cover rounded-md" src="{{$image->getPathImage()}}"/>
                                            <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                                                <div class="flex">
                                                    <span class="p-1">
                                                    <i>
                                                        <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                                        </svg>
                                                    </i>
                                                    </span>
                                                    <p class="p-1 size text-xs"></p>
                                                </div>
                                            </section>
                                        </a>
                                    </article>
                                </li>
                                {{-- </template> --}}
                                @endforeach
                            </ul>
                        </div>
                        @else
                        <div id="empty" class="h-full w-full text-center flex flex-col items-center justify-center">
                            <img class="mx-auto w-32" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" alt="no data" />
                            <span class="text-small text-gray-500">Sin imágenes</span>
                        </div>
                        @endif
                    </div>

                    {{-- <p>{{ var_dump($readingQuestionnarie) }}</p> --}}
                    @if (!is_null($readingQuestionnarie))
                        @if ($readingQuestionnarie->status)
                            <div class="md:col-span-1 mb-4">
                                <div class="flex items-center mb-4" >
                                    <div class="flex-grow">
                                        <div class="mt-2 text-md">
                                            Ahora puede reforzar tus conociemintos de esta lectura llenado el siguiente cuestionario. Para ello, selecciona la siguiente opción.
                                        </div>
                                    </div>
                                    <a href="{{ route('content.questionnarie', $readingQuestionnarie->id) }}" class="bg-green-300 hover:bg-green-400 rounded-md capitalize px-3 py-2 mr-2">
                                        Llenar cuestionario
                                    </a>
                                    {{-- <button wire:click="goToQuestionnarie({{$readingQuestionnarie->id}})" class=""></button> --}}
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .hasImage:hover section {
          background-color: rgba(5, 5, 5, 0.4);
        }
        .hasImage:hover button:hover {
          background: rgba(5, 5, 5, 0.45);
        }
    </style>
</div>