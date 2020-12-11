<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cuestionario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-2 text-2xl">
                        Listado de preguntas
                    </div>

                    <div class="mt-4 text-gray-500 mb-2">
                        A continuación puedes obsevar el listado de estudiantes registrados.
                    </div>

                    @foreach ($questions as $question)
                        <p>{{ $question->content }}</p>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>