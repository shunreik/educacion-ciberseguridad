<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    
    <div class="mt-2 text-2xl">
        {{ config('app.name', 'Laravel') }}
    </div>

    <div class="mt-4 text-gray-500 mb-2">
        Este proyecto propone implementar una aplicación web educativa orientada al aprendizaje en seguridad informática, permitiendo generar estrategias de identificación y defensa ante ataques de ingeniería social y suplantación de identidad. 
    </div>
    <div class="mt-4 text-gray-500 mb-2">
        A continuación, se te presenta lo que puedes realizar:
    </div>
</div>

<div class="flex items-center justify-center px-5 py-5">
    <div class="w-full max-w-3xl">
        <div class="-mx-2 md:flex">

            @can('manage.students')
            <div class="w-full md:w-1/2 px-2">
                <div class="rounded-lg shadow-sm mb-4">
                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                        <div class="px-3 pt-8 pb-10 text-center relative z-10">
                            <h4 class="text-sm uppercase text-gray-500 leading-tight"><a href="{{ route('student') }}">Módulo Estudiante</a></h4>
                            <p class="text-xs text-green-500 leading-tight"> Puedes listar a todos los estudiantes registrados, observar a detalle la información de un estudiante, activar o desactivar a un determinado esrudiante para impedir o permitir su acceso a la aplicación web.</p>
                            <a href="{{ route('student') }}" class="mt-3 w-1/2 inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                <span class="mx-auto">Visitar módulo</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            
            @can('manage.teachers')
            <div class="w-full md:w-1/2 px-2">
                <div class="rounded-lg shadow-sm mb-4">
                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                        <div class="px-3 pt-8 pb-10 text-center relative z-10">
                            <h4 class="text-sm uppercase text-gray-500 leading-tight"><a href="{{ route('teacher') }}">Módulo Profesor</a></h4>
                            <p class="text-xs text-green-500 leading-tight"> Puedes listar a todos los profesores registrados, visualizar, registrar, actualizar a un determinado profesor. Además, puede activar o descativar a los profesores para permitir o impedir su acceso a la aplicación web.</p>
                            <a href="{{ route('teacher') }}" class="mt-3 w-1/2 inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                <span class="mx-auto">Visitar módulo</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            @can('manage.readings')
            <div class="w-full md:w-1/2 px-2">
                <div class="rounded-lg shadow-sm mb-4">
                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                        <div class="px-3 pt-8 pb-10 text-center relative z-10">
                            <h4 class="text-sm uppercase text-gray-500 leading-tight"><a href="{{ route('reading') }}">Módulo Lectura</a></h4>
                            <p class="text-xs text-green-500 leading-tight"> Puedes listar a todas las lecturas registradas, visualizar, registrar, actualizar a un determinado registro. También, puede privar o publicar a las lecturas para permitir o impedir su visibilidad a los estudiantes.</p>
                            <a href="{{ route('reading') }}" class="mt-3 w-1/2 inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                <span class="mx-auto">Visitar módulo</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            @can('manage.questionnaries')
            <x-cards.module class="border-gray-200 md:border-l border-b">
                <x-slot name='icon'>
                    <img src="https://img.icons8.com/material/50/000000/view-module.png" class="w-8 h-8"/>
                </x-slot>
                <x-slot name='title'><a href="{{ route('questionnarie') }}">Módulo Cuestionario</a></x-slot>
                <x-slot name="description">
                    Puedes listar a todas los cuestionarios registradas, agregar o editar un cuestionario asignado a una determinada lectura. También, puedes publicar tu cuestionario o privarlo para que sea accedido por los estudiantes.
                </x-slot>
                <x-link-module href="{{ route('questionnarie') }}">
                    Visitar módulo
                </x-link-module>
            </x-cards.module>
            @endcan

            {{-- @can('manage.readings') --}}
            <x-cards.module class="border-gray-200 border-t border-r">
                <x-slot name='icon'>
                    <img src="https://img.icons8.com/material/50/000000/view-module.png" class="w-8 h-8"/>
                </x-slot>
                <x-slot name='title'><a href="{{ route('content') }}">Módulo Contenido</a></x-slot>
                <x-slot name="description">
                    Visualiza, según la temática, las lecturas registradas por parte de los profesores de la aplicación web.
                </x-slot>
                <x-link-module href="{{ route('content') }}">
                    Visitar módulo
                </x-link-module>
            </x-cards.module>
            {{-- @endcan --}}

            @can('show.qualification')
            <x-cards.module class="border-gray-200 md:border-l">
                <x-slot name='icon'>
                    <img src="https://img.icons8.com/material/50/000000/view-module.png" class="w-8 h-8"/>
                </x-slot>
                <x-slot name='title'><a href="{{ route('questionnarie') }}">Módulo Calificaciones</a></x-slot>
                <x-slot name="description">
                    Puedes listar tus calificaiones de los cuestionarios completados.
                </x-slot>
                <x-link-module href="{{ route('qualifications') }}">
                    Visitar módulo
                </x-link-module>
            </x-cards.module>
            @endcan
            
        </div>
    </div>
</div>