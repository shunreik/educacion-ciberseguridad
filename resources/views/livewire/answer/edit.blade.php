<x-jet-dialog-modal wire:model="editAnswerMode">
    <x-slot name="title">
        <h1 class="uppercase">Editar respuesta</h1>
        <h4 class="mt-2 text-gray-600">{{ $questionContent }}</h4>
    </x-slot>

    <x-slot name="content">
        {{-- Editar respuesta --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="answerContent" value="Respuesta" />
            <x-jet-input id="answerContent" type="text" class="mt-1 block w-full" wire:model="answerContent"/>
            <x-jet-input-error for="answerContent" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('editAnswerMode', false)">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button type='button' wire:loading.attr="disabled" wire:click="updateAnswer">
            Editar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>