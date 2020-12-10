<x-jet-dialog-modal wire:model="createOptionMode">
    <x-slot name="title">
        <h1 class="uppercase">Registrar opción</h1>
        <h4 class="mt-2 text-gray-600">{{ $questionContent }}</h4>
    </x-slot>

    <x-slot name="content">
        {{-- Formulario para registrar una respuesta --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="optionContent" value="Opción" />
            <x-jet-input id="optionContent" type="text" class="mt-1 block w-full" wire:model="optionContent"/>
            <x-jet-input-error for="optionContent" class="mt-2" />
        </div>

        <p class="text-sm text-gray-500 mt-6">
            Recuarda que al agregar la opción no podrás eliminarla, solo podrás modificarla.
        </p>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('createOptionMode', false)">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button type='button' wire:loading.attr="disabled" wire:click="storeOption">
            Registrar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>