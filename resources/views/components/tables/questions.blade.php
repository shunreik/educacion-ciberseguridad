@props(['reading', 'questionnarie'])
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col mt-4">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                        <x-tables.th content='Pregunta'/>
                        <x-tables.th content='Respuesta'/>
                        <x-tables.th content='Opciones'/>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        @if ($questionnarie)
                            @foreach ($questionnarie->questions as $question)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $question->content }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($question->answer)
                                            <div class="text-sm text-gray-900">{{ $question->answer->content}}</div>
                                        @else
                                            <div class="text-sm text-red-900">Sin asignar</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if (count($question->options) > 0)
                                            @foreach ($question->options as $option)
                                                <div class="text-sm text-gray-900">{{ $option->content}}</div>
                                            @endforeach
                                        @else
                                            <div class="text-sm text-red-900">Sin asignar</div>
                                        @endif
                                    </td>

                                    <td class="px-1 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-center">
                                            <button class="text-green-600 hover:text-green-900 mx-3">Agregar Respuesta</button>
                                            <button class="text-blue-600 hover:text-blue-900 mx-3">Agregar Opción</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                {{-- Personalización del paginator de tailwind --}}
                {{-- {{ $data->links() }} --}}
            </div>
        </div>
    </div>
</div>