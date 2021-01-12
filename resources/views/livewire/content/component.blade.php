<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            Módulo Contenido
        </h2>
    </x-slot>

    <div class="pt-12 py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="mt-2 text-2xl font-medium text-gray-900">Temáticas</h3>
            
                    <p class="mt-1 text-sm text-gray-600">
                        ¿Alguna vez te has preguntado como obtienen tu información por internet, como se oculta tu clave o si existen secretos en las imagenes?. En esta sección lo descubrirás. Da clic en la temática de tu interés y no pares de aprender!
                    </p>
                </div>
            </div>
            
            
            <div class="flex items-center justify-center px-5 py-5">
                <div class="w-full max-w-3xl">
                    <div class="-mx-2 md:flex">
            
                        @foreach ($topics as $topic)
                        <div class="w-full md:w-1/3 px-2">
                            <div class="rounded-lg shadow-sm mb-4">
                                <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                    <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                        <h4 class="text-sm uppercase text-gray-500 leading-tight">{{ $topic->title }}</h4>
                                        <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ count($topic->readings()->where('status', true)->get() )}}</h3>
                                        <p class="text-xs text-green-500 leading-tight">Lecturas</p>
                                        <a href="{{route('content.topic', $topic->id)}}" class="mt-3 w-1/2 inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                            <span class="mx-auto">Ver Lecturas</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
