<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Módulo Calificaciones
        </h2>
    </x-slot>

    @if (session()->has('success'))
        <x-alerts.toast id="alert">
            <x-slot name="message">{{ session('success') }}</x-slot>
            <button type="button" class="text-green-700" onclick="closeAlert()">
                <span class="">&times;</span>
            </button>
        </x-alerts.toast>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-2 text-2xl">
                        Listado de tus calificaciones
                    </div>

                    <div class="mt-4 text-gray-500 mb-2">
                        A continuación puedes obsevar el puntaje obtenido en los cuestionarios completados.
                    </div>

                    <x-tables.qualification :scores="$scores"/>

                </div>
            </div>
        </div>
    </div>

    <script>
        function closeAlert() {
          document.getElementById("alert").classList.add('hidden');
        }
    </script>
</x-app-layout>