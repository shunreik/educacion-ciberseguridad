<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center mb-4" >
          <div class="flex-grow">
              <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Lectura
              </h2>
          </div>
          <a href="{{route('reading')}}" class="inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Regresar</a>
      </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <div class='md:grid md:grid-cols-3 md:gap-6'>
            <x-jet-section-title>
                <x-slot name="title">Formulario</x-slot>
                <x-slot name="description">A continuación, puedes actualizar a la lectura seleccionada</x-slot>
            </x-jet-section-title>
        
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form  method="POST" id='form-update-reading' action="{{ route('update.reading', $reading->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <!-- Tile -->
                                <div class="col-span-6 sm:col-span-5">
                                    <x-jet-label for="title" value="Título" />
                                    <x-jet-input type="text" id="title" name='title' class="mt-1 block w-full" autocomplete="name" value="{{ $reading->title }}" />
                                    <p class="mt-2 text-sm text-red-600 hidden"></p>
                                </div>

                                <!-- Description -->
                                <div class="col-span-6 sm:col-span-5">
                                    <x-jet-label for="description" value="Description" />
                                    <textarea name="description" id="description" class="resize border rounded-md mt-1 block w-full" rows="10">{{ $reading->description }}</textarea>
                                    <p class="mt-2 text-sm text-red-600 hidden"></p>
                                </div>

                                <!-- Topic -->
                                <div class="col-span-6 sm:col-span-5">
                                  <x-jet-label for="topic" value="Temática" />
                                  <select name="topic_id" id="topic" class="form-select rounded-md shadow-sm mt-1 w-full">
                                    @foreach ($topics as $topic)
                                        @if ($topic->id === $reading->topic->id)
                                            <option value="{{ $topic->id}}" selected>{{ $topic->title}}</option> 
                                        @else
                                            <option value="{{ $topic->id}}">{{ $topic->title}}</option> 
                                        @endif
                                    @endforeach
                                  </select>
                                  <p class="mt-2 text-sm text-red-600 hidden"></p>
                                </div>

                                <!-- Level -->
                                <div class="col-span-6 sm:col-span-5">
                                  <x-jet-label for="level" value="Nivel" />
                                  <select name="level_id" id="level" class="form-select w-full rounded-md shadow-sm mt-1">
                                    @foreach ($levels as $level)
                                        @if ($level->id === $reading->level->id)
                                            <option value="{{ $level->id}}" selected>{{ $level->name}}</option> 
                                        @else
                                            <option value="{{ $level->id}}" >{{ $level->name}}</option> 
                                        @endif
                                    @endforeach
                                  </select>
                                  <p class="mt-2 text-sm text-red-600 hidden"></p>
                                </div>

                                <!-- Imágenes-->
                                <div class="col-span-6 sm:col-span-5">
                                    
                                    @if (count($oldImages) > 0)
                                    <span id="infOldImages" class="hidden">
                                        @foreach ($oldImages as $image)
                                            <span data-path="{{ $image->path }}"> {{ $image->getPathImage() }}</span>
                                        @endforeach
                                      </span>
                                    @endif

                                    <x-jet-label for="images" value="Imágenes (Opcional)" />
                                    <!-- scroll area -->
                                    <section class="h-full overflow-auto p-8 w-full flex flex-col" id="multi-upload">

                                        <ul id="gallery-upload" class="flex flex-1 flex-wrap">
                                            {{-- Agregar imágenes actuguas del reading--}}
                                        </ul>

                                        <input id="hidden-input" type="file" multiple class="hidden" />
                                        <button id="upload" type="button" class="m-0 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none  inline-flex items-center justify-center">
                                            <svg class=" bg-gray-200" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                                            </svg>
                                            
                                            <span class="ml-2">Subir imágenes</span>
                                        </button>
                                        <p class="mt-2 text-sm text-red-600 hidden"></p>
                                            
                                        <ul id="gallery" class="flex flex-1 flex-wrap mt-2">
                                            {{-- Agregar nuevas imágenes --}}
                                        </ul>

                                        <div id="empty" class="h-full w-full text-center flex flex-col items-center justify-center">
                                            <img class="mx-auto w-32" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" alt="no data" />
                                            <span class="text-small text-gray-500">Sin imágenes</span>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <x-jet-button type='submit' id="save">
                                Guardar
                            </x-jet-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <template id="image-template">
        {{-- <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24"> --}}
        <li class="block p-1 w-1/2 h-40">
          {{-- group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm --}}
          <article tabindex="0" class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
            <img alt="upload preview" class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />
    
            <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
              {{-- <h1 class="flex-1"></h1> --}}
              <div class="flex">
                <span class="p-1">
                  <i>
                    <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                    </svg>
                  </i>
                </span>
    
                <p class="p-1 size text-xs"></p>
                <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md" type="button">
                  <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path class="pointer-events-none" d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                  </svg>
                </button>
              </div>
            </section>
          </article>
        </li>
      </template>

      <style>
        .hasImage:hover section {
          background-color: rgba(5, 5, 5, 0.4);
        }
        .hasImage:hover button:hover {
          background: rgba(5, 5, 5, 0.45);
        }
    </style>
</x-app-layout>