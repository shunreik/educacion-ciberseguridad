@props(['questions'])
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
                        <x-tables.th content=''/>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        @if ($questions)
                            @foreach ($questions as $question)
                                <tr>
                                    <td class="px-6 py-4  whitespace-nowrap">
                                        <div class="grid grid-flow-col grid-cols-12">
                                            <button type="button" class="col-span-1 flex justify-self-center self-center mr-2" wire:click="editQuestion('{{ $question->id }}')">
                                                <x-icons.edit class="w-5 h-5 fill-current "/>
                                            </button>
                                            <div class="text-sm text-gray-900 col-span-11">{{ $question->content }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($question->answer)
                                            <div class="grid grid-flow-col grid-cols-3">
                                                <button type="button" class="col-span-1 flex justify-self-center self-center mr-2" wire:click="editAnswer('{{ $question->answer->id }}')">
                                                    <x-icons.edit class="w-5 h-5 fill-current "/>
                                                </button>
                                                <div class="col-span-2 text-sm text-gray-900">{{ $question->answer->content}}</div>
                                            </div>
                                        @else
                                            <div class="text-sm text-red-900">Sin asignar</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if (count($question->options) > 0)
                                            @foreach ($question->options as $option)
                                                <div class="grid grid-flow-col grid-cols-3 my-3">
                                                    <button type="button" class="col-span-1 flex justify-self-center self-center mr-2" wire:click="editOption('{{ $option->id }}')">
                                                        <x-icons.edit class="w-5 h-5 fill-current "/>
                                                    </button>
                                                    <div class="col-span-2 text-sm text-gray-900">{{ $option->content}}</div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-sm text-red-900">Sin asignar</div>
                                        @endif
                                    </td>

                                    <td class="px-1 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex flex-row justify-center">
                                            @if (is_null($question->answer))
                                            <button wire:click="createAnswer('{{ $question->id }}')" class="flex justify-items-center items-center text-green-600 hover:text-green-900 mx-3">
                                                <x-icons.add class="w-5 h-5 fill-current"/>
                                                <span class="ml-1">Respuesta</span>
                                            </button>
                                            @endif
                                            @if (count($question->options) < 4)
                                            <button wire:click="createOption('{{ $question->id }}')" class="flex justify-items-center items-center text-blue-600 hover:text-blue-900 mx-3">
                                                <x-icons.add class="w-5 h-5 fill-current"/>
                                                <span class="ml-1">Opción</span>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                @if ($questions)
                {{-- Personalización del paginator de tailwind --}}
                {{ $questions->links() }}
                @endif
            </div>
        </div>
    </div>
</div>