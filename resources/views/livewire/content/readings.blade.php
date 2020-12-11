
<div class="md:col-span-1">
    <div class="px-4 sm:px-0">
        

       

        <div class="flex items-center mb-4" >
            <div class="flex-grow">
                <h3 class="mt-2 text-2xl font-medium text-gray-900">Lecturas</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti illum alias perspiciatis ut error exercitationem commodi deleniti at sequi officiis fugiat ratione, soluta maxime vel odio, hic nulla nostrum? Modi!
                </p>
            </div>
            <x-jet-button type="button" class="mx-3" wire:click="$set('view', 'topics')"> Regresar</x-jet-button>
        </div>
    </div>
</div>


<div class="container my-12 mx-auto px-4 md:px-12">
    <div class="flex flex-wrap -mx-1 lg:-mx-4">

            <!-- component -->
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                {{-- <div class="w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3  bg-white shadow-md rounded-md mx-1"> --}}
                <div class="overflow-hidden rounded-lg shadow-lg px-4 py-3">

                    <div class="flex justify-between items-center">
                        <span class="text-sm font-light text-gray-800">Ataque de informático</span>
                        <span class="bg-indigo-200 text-indigo-800 px-3 py-1 rounded-full uppercase text-xs">Intermedio</span>
                    </div>

                    <div>
                        <h1 class="text-lg font-semibold text-gray-800 mt-2">Título de la lectura registrada</h1>
                        <p class="text-gray-600 text-sm mt-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero ipsam error earum est! Et, quas. Optio repellendus nihil facere, quae nobis neque repudiandae molestias ipsa earum soluta, quis aliquid odit!</p>
                    </div>

                    <div>
                        <div class="flex items-center mt-2 text-gray-700">
                            <a class="text-blue-600 cursor-pointer mx-2 hover:underline">Ver más</a>
                        </div>

                        <div class="flex justify-between items-center mt-4">
                            <div class="flex items-center">
                                <img src="https://images.unsplash.com/photo-1502791451862-7bd8c1df43a7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                        class="w-8 h-8 object-cover rounded-full" alt="avatar">
                                <a class="text-gray-700 text-sm mx-3" href="#">Alex steve</a>
                            </div>
                            <span class="font-light text-sm text-gray-600">Mar 10, 2018</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-2 text-2xl">
                Lecturas
            </div>
            <div class="mt-4 text-gray-500 mb-2">
                A continuación puedes obsevar el listado de profesores registrados.
            </div>

            

            
            


            @php
                // echo "prueba de wordwrap";
                $text = "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero ipsam error earum est! Et, quas. Optio repellendus nihil facere, quae nobis neque repudiandae molestias ipsa earum soluta, quis aliquid odit!";
                $text2 = 'Hola';

                $lengthText = strlen($text2);//longitud de un string
                $maxLenghText = 200;//máximos caracteres permitidos al post debe tener como mínimo 250 caracteres

                $cutText = $lengthText > $maxLenghText ? $maxLenghText : $lengthText;

                $descriptionText = substr($text2, 0, $cutText );

                echo "Texto original: $text2 <br> Longitud del texto: $lengthText <br> Longitud a cortar: $cutText <br> Texto de descripción: $descriptionText ..." ;
            @endphp

        </div>
    </div> --}}
</div>
