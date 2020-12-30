<div>
    <x-slot name="header">
        <div class="flex items-center mb-4" >
            <div class="flex-grow">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Lecturas
                </h2>
            </div>
            <a href="{{route('content')}}" class="inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Regresar</a>
        </div>
    </x-slot>

    <div class="pt-12 py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">

                    <div class="grid lg:grid-cols-2 gap-1 mb-4">
                        <div class="mt-2 text-2xl font-medium text-gray-900">
                            {{ $topicTitle }}
                        </div>

                        <div class="box my-4 lg:my-0">
                            <div class="box-wrapper">
                                <div class=" bg-white rounded-full flex items-center w-full p-3 shadow-sm border border-gray-200">
                                  <div  class="outline-none focus:outline-none"><svg class=" w-5 text-gray-600 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></div>
                                  <input type="search" name="" id="" wire:model="search" placeholder="Buscar lectura" class="w-full pl-4 text-sm outline-none focus:outline-none bg-transparent">
                                  <div class="select">
                                    <select name="" id="" wire:model="typeSearch" class="text-sm outline-none focus:outline-none bg-transparent mx-2">
                                      <option value="title" selected>Título</option>
                                      <option value="autor">Autor</option>
                                      <option value="level">Nivel</option>
                                     </select>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="mt-1 text-sm text-gray-600 mb-2">
                        {{ $topicDescription }}
                    </p>

                    @can('fill.questionnarie')
                        <div class="flex justify-center mt-4">
                            <x-filters.status>
                                <x-buttons.filter class="{{$listReadings ? 'active' : ''}}" wire:click='allReadings'>Todos</x-buttons.filter>
                                <x-buttons.filter color='green' class="{{$listCuestionnaries ? 'active' : ''}}" wire:click='onlyCuestionnaries'>Cuestionario</x-buttons.filter>
                            </x-filters.status>
                        </div>
                    @endcan
                    
                </div>
            </div>

            <div class="container my-2 mx-auto px-4 md:px-12">
                @if (count($readings) > 0)
                    <div class="flex flex-wrap -mx-1 lg:-mx-4">
                    @foreach ($readings as $reading)
                        <x-cards.reading>
                            <x-slot name="title">{{ $reading->title }}</x-slot>
                            <x-slot name="description">
                                @php
                                    $text = $reading->description;
                                    $lengthText = strlen($text);//longitud de un string
                                    $maxLenghText = 145;//máximos caracteres permitidos al post debe tener como mínimo 250 caracteres
                                    $cutText = $lengthText > $maxLenghText ? $maxLenghText : $lengthText;
                                    $descriptionText = substr($text, 0, $cutText );
                                @endphp
                                {{ $descriptionText." ..." }}
                            </x-slot>
                            <x-slot name="autor">{{ $reading->user->nickname }}</x-slot>
                            <x-slot name="photo">{{ $reading->user->profile_photo_url }}</x-slot>
                            <x-slot name="date">{{ $reading->created_at->format('d M Y') }}</x-slot>
                            <div class="flex items-center mt-2 text-gray-700">
                                <a href="{{ route('content.reading', $reading->id) }}" class="text-blue-600 cursor-pointer mx-2 hover:underline">Ver más</a>
                            </div>

                            @can('fill.questionnarie')
                                @if (!is_null($reading->questionnarie))
                                        @if ($reading->questionnarie->status)
                                        <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full uppercase text-xs">
                                            Cuestionario
                                        </span>
                                        @endif
                                @endif
                            @endcan

                            @if ($reading->level->weighing >= 0 && $reading->level->weighing < 50)
                            <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full uppercase text-xs">
                                {{ $reading->level->name }}
                            </span>
                            @endif
                            @if ($reading->level->weighing >= 50 && $reading->level->weighing < 100)
                            <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full uppercase text-xs">
                                {{ $reading->level->name }}
                            </span>
                            @endif
                            @if ($reading->level->weighing >= 100)
                            <span class="bg-red-200 text-red-800 px-3 py-1 rounded-full uppercase text-xs">
                                {{ $reading->level->name }}
                            </span>
                            @endif

                            </x-cards.reading>
                    @endforeach
                    </div>
                @else
                    <p class="mt-6 text-sm text-gray-600 mb-4 text-center">Sin resultados</p>
                @endif
                    
                
                <div class="my-3">
                    {{-- Personalización del paginator de tailwind --}}
                    {{ $readings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
