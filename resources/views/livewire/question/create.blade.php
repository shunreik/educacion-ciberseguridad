<x-jet-dialog-modal wire:model="createQuestionMode">
    <x-slot name="title">
        <h1 class="uppercase">Registrar pregunta</h1>
    </x-slot>

    <x-slot name="content">
        {{-- Formulario para registrar una pregunta --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="questionContent" value="Pregunta" />
            <x-jet-input id="questionContent" type="text" class="mt-1 block w-full" wire:model="questionContent" />
            <x-jet-input-error for="questionContent" class="mt-2" />
        </div>

        <p class="text-sm text-gray-500 mt-6">
            Recuarda que al agregar una nueva pregunta no podrás eliminarla, solo podrás modificar.
        </p>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('createQuestionMode', false)">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button type='button' wire:loading.attr="disabled" wire:click="storeQuestion">
            Registrar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>