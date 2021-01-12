<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div> --}}

    <div class="mt-2 text-2xl">
        Bienvenido
    </div>

    <div class="mt-4 text-gray-500 mb-2">
        A continuación, se presentan los módulos asignados a tu usuario:
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">

    @can('manage.students')
    <x-cards.module>
        <x-slot name='icon'>
            <img src="https://img.icons8.com/material/24/000000/student-male--v1.png" class="w-8 h-8"/>
        </x-slot>
        <x-slot name='title'><a href="{{ route('student') }}">Módulo Estudiante</a></x-slot>
        <x-slot name="description">
            Aquí puedes visualizar todos los estudiantes registrados con su información detallada y activar o desactivar a un determinado estudiante para permitir o impedir su acceso a la Aplicación Web.
        </x-slot>
        <x-link-module href="{{ route('student') }}">
            Ir a Estudiantes
        </x-link-module>
    </x-cards.module>
    @endcan
    
    @can('manage.teachers')
    <x-cards.module class="border-gray-200 md:border-t-0 md:border-l border-b">
        <x-slot name='icon'>
            <img src="https://img.icons8.com/material/24/000000/school-house.png" class="w-8 h-8"/>
        </x-slot>
        <x-slot name='title'><a href="{{ route('teacher') }}">Módulo Profesor</a></x-slot>
        <x-slot name="description">
            Aquí puedes visualizar todos los profesores registrados con su información a detalle y actualizarla. Además puedes añadir nuevos registros y activar o desactivar a un determinado profesor para permitir o impedir su acceso a la Aplicación Web.
        </x-slot>
        <x-link-module href="{{ route('teacher') }}">
            Ir a Profesores
        </x-link-module>
    </x-cards.module>
    @endcan

    @can('manage.readings')
    <x-cards.module class="border-gray-200">
        <x-slot name='icon'>
            <img src="https://img.icons8.com/material/24/000000/read--v1.png" class="w-8 h-8"/>
        </x-slot>
        <x-slot name='title'><a href="{{ route('reading') }}">Módulo Lectura</a></x-slot>
        <x-slot name="description">
            Aquí puedes visualizar todas las lecturas que has registrado con su contenido a detalle y actualizarlo. Además puedes añadir nuevos registros y publicar u ocultar una determinada lectura para permitir o impedir su visibilidad en el Módulo Contenido.
        </x-slot>
        <x-link-module href="{{ route('reading') }}">
            Ir a Lecturas
        </x-link-module>
    </x-cards.module>
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
