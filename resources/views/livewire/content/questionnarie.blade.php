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
                        A continuación puedes obsevar las preguntas que componen al cuestionario
                    </div>


                    {{-- Formulario --}}

                    <form wire:submit.prevent="submit">
        
                         
                        {{-- <select id="pregunta.0" name="pregunta.0" wire:model="pregunta.0" class="form-select rounded-md shadow-sm mt-1 w-full">
                            <option value="" >Seleccione una opción</option> 
                            <option value="option1">Opción 1</option>
                            <option value="option2">Opción 2</option>
                        </select>
                        <x-jet-input-error for="pregunta.0" class="mt-2" />

                        <select id="pregunta.1" name="pregunta.1" wire:model="pregunta.1" class="form-select rounded-md shadow-sm mt-1 w-full">
                            <option value="" >Seleccione una opción</option> 
                            <option value="option1">Opción 1</option>
                            <option value="option2">Opción 2</option>
                        </select>
                        <x-jet-input-error for="pregunta.1" class="mt-2" /> --}}

                        


                        @php
                            $count = 0;
                        @endphp

                        @foreach ($questionForm as $name => $input)

                            <div class="col-span-6 sm:col-span-5 mb-5">
                                <x-jet-label for="{{ $name }}" value="{{ $input['question']->content }}" />
                                
                                @foreach ($input['options'] as $option)
                                    <div>
                                        <input type="radio" id="{{$count}}" name="{{ $name }}" value="{{$option->id}}">
                                        <label for="{{$count}}">{{$option->content}}</label>
                                    </div>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach

                                {{-- <select id="{{ $name }}" name="{{ $name }}" wire:model="test." class="form-select rounded-md shadow-sm mt-1 w-full">
                                    
                                    <option value="" >Seleccione una opción</option> 
                                    @foreach ($input['options'] as $option)
                                    <option value="{{ $option->id }}">{{$option->content}}</option> 
                                    @endforeach

                                </select> --}}
                                {{-- <x-jet-input-error for="question[]" class="mt-2" /> --}}
                            </div>
                        @endforeach

                        <x-jet-button type="submit">Enviar</x-jet-button>

                    </form>
                   

                </div>
            </div>
        </div>
    </div>
</div>