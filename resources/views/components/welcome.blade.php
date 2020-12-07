<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div> --}}

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

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">

    @can('manage.students')
    <x-cards.module>
        <x-slot name='icon'>
            <img src="https://img.icons8.com/material/50/000000/view-module.png" class="w-8 h-8"/>
        </x-slot>
        <x-slot name='title'><a href="{{ route('student') }}">Módulo Estudiante</a></x-slot>
        <x-slot name="description">
            Puedes listar a todos los estudiantes registrados, observar a detalle la información de un estudiante, activar o desactivar a un determinado esrudiante para impedir o permitir su acceso a la aplicación web.
        </x-slot>
        <x-link-module href="{{ route('student') }}">
            Visitar módulo
        </x-link-module>
    </x-cards.module>
    @endcan
    
    @can('manage.teachers')
    <x-cards.module class="border-gray-200 md:border-t-0 md:border-l">
        <x-slot name='icon'>
            <img src="https://img.icons8.com/material/50/000000/view-module.png" class="w-8 h-8"/>
        </x-slot>
        <x-slot name='title'><a href="{{ route('teacher') }}">Módulo Profesor</a></x-slot>
        <x-slot name="description">
            Puedes listar a todos los profesores registrados, visualizar, registrar, actualizar a un determinado profesor. Además, puede activar o descativar a los profesores para permitir o impedir su acceso a la aplicación web.
        </x-slot>
        <x-link-module href="{{ route('teacher') }}">
            Visitar módulo
        </x-link-module>
    </x-cards.module>
    @endcan

    @can('manage.readings')
    <x-cards.module class="border-t border-gray-200">
        <x-slot name='icon'>
            <img src="https://img.icons8.com/material/50/000000/view-module.png" class="w-8 h-8"/>
        </x-slot>
        <x-slot name='title'><a href="{{ route('reading') }}">Módulo Lectura</a></x-slot>
        <x-slot name="description">
            Puedes listar a todas las lecturas registradas, visualizar, registrar, actualizar a un determinado registro. Además, puede privar o publicar a las lecturas para permitir o impedir su visibilidad a los estudiantes.
        </x-slot>
        <x-link-module href="{{ route('reading') }}">
            Visitar módulo
        </x-link-module>
    </x-cards.module>
    @endcan

    <x-cards.module class="border-t border-gray-200 md:border-l">
        <x-slot name='icon'>
            <img src="https://img.icons8.com/material/50/000000/view-module.png" class="w-8 h-8"/>
        </x-slot>
        <x-slot name='title'><a href="#">Módulo Prueba2</a></x-slot>
        <x-slot name="description">
            Descripción
        </x-slot>
        <x-link-module href="#">
            Visitar módulo
        </x-link-module>
    </x-cards.module>

</div>
