<x-jet-dialog-modal wire:model="createAnswerMode">
    <x-slot name="title">
        <h1 class="uppercase">Registrar respuesta</h1>
        <h4 class="mt-2 text-gray-600">{{ $questionContent }}</h4>
    </x-slot>

    <x-slot name="content">
        {{-- Registrar de respuesta --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="answerContent" value="Respuesta" />
            <x-jet-input id="answerContent" type="text" class="mt-1 block w-full" wire:model="answerContent"/>
            <x-jet-input-error for="answerContent" class="mt-2" />
        </div>

        <p class="text-sm text-gray-500 mt-6">
            Recuerda: Al agregar la respuesta no podrás eliminarla, solo modificarla.
        </p>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('createAnswerMode', false)">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button type='button' wire:loading.attr="disabled" wire:click="storeAnswer">
            Registrar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>