<x-jet-dialog-modal wire:model="editQuestionMode">
    <x-slot name="title">
        <h1 class="uppercase">Actualizar pregunta</h1>
    </x-slot>

    <x-slot name="content">
        {{-- Formulario para registrar una pregunta --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="questionContent" value="Pregunta" />
            <x-jet-input id="questionContent" type="text" class="mt-1 block w-full" wire:model="questionContent" />
            <x-jet-input-error for="questionContent" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('editQuestionMode', false)">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button type='button' wire:loading.attr="disabled" wire:click="updateQuestion">
            Actualizar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>