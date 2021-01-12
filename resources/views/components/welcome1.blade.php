<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    
    <div class="mt-2 text-2xl">
        Bienvenido
    </div>

    <div class="mt-4 text-gray-500 mb-2">
        A continuación, se presentan los módulos asignados a tu usuario:
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
                            <p class="text-xs text-green-500 leading-tight"> Aquí puedes visualizar todos los estudiantes registrados con su información detallada y activar o desactivar a un determinado estudiante para permitir o impedir su acceso a la Aplicación Web.</p>
                            <a href="{{ route('student') }}" class="mt-3 w-1/2 inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                <span class="mx-auto">Ir a Estudiantes</span>
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
                            <p class="text-xs text-green-500 leading-tight">Aquí puedes visualizar todos los profesores registrados con su información a detalle y actualizarla. Además puedes añadir nuevos registros y activar o desactivar a un determinado profesor para permitir o impedir su acceso a la Aplicación Web.</p>
                            <a href="{{ route('teacher') }}" class="mt-3 w-1/2 inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                <span class="mx-auto">Ir a Profesores</span>
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
                            <p class="text-xs text-green-500 leading-tight">Aquí puedes visualizar todas las lecturas que has registrado con su contenido a detalle y actualizarlo. Además puedes añadir nuevos registros y publicar u ocultar una determinada lectura para permitir o impedir su visibilidad en el Módulo Contenido.</p>
                            <a href="{{ route('reading') }}" class="mt-3 w-1/2 inline-flex ml-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                <span class="mx-auto">Ir a Lecturas</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            @can('manage.questionnaries')
            <x-cards.module class="border-gray-200 md:border-l border-b">
                <x-slot name='icon'>
                    <img src="https://img.icons8.com/material/24/000000/school--v1.png" class="w-8 h-8"/>
                </x-slot>
                <x-slot name='title'><a href="{{ route('questionnarie') }}">Módulo Cuestionario</a></x-slot>
                <x-slot name="description">
                    Aquí puedes visualizar todos los cuestionarios que has registrado con su contenido a detalle y actualizarlo. Además puedes añadir nuevos registros y publicar u ocultar un determinado cuestionario para permitir o impedir su visibilidad a los estudiantes.
                </x-slot>
                <x-link-module href="{{ route('questionnarie') }}">
                    Ir a Cuestionarios
                </x-link-module>
            </x-cards.module>
            @endcan

            {{-- @can('manage.readings') --}}
            <x-cards.module class="border-gray-200 border-t border-r">
                <x-slot name='icon'>
                    <img src="https://img.icons8.com/material/24/000000/table-of-content.png" class="w-8 h-8"/>
                </x-slot>
                <x-slot name='title'><a href="{{ route('content') }}">Módulo Contenido</a></x-slot>
                <x-slot name="description">
                    Aquí puedes visualizar según la temática, las lecturas registradas por los profesores.
                </x-slot>
                <x-link-module href="{{ route('content') }}">
                    Ir a Contenido
                </x-link-module>
            </x-cards.module>
            {{-- @endcan --}}

            @can('show.qualification')
            <x-cards.module class="border-gray-200 md:border-l">
                <x-slot name='icon'>
                    <img src="https://img.icons8.com/material/24/000000/contract--v1.png" class="w-8 h-8"/>
                </x-slot>
                <x-slot name='title'><a href="{{ route('questionnarie') }}">Módulo Calificaciones</a></x-slot>
                <x-slot name="description">
                    Aquí puedes visualizar las calificaciones obtenidas y la retroalimentación de los cuestionarios que has resuelto.
                </x-slot>
                <x-link-module href="{{ route('qualifications') }}">
                    Ir a Calificaciones
                </x-link-module>
            </x-cards.module>
            @endcan
            
        </div>
    </div>
</div>