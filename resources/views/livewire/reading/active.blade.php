<x-jet-dialog-modal wire:model="publicMode">
    <x-slot name="title">
        <h1 class="uppercase">Confirmar publicación de la lectura</h1>
    </x-slot>

    <x-slot name="content">
        La lectura con el título de: <span class="font-bold">{{ $title }}</span>, va a ser publicada para los estudiantes.
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('publicMode')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-button class="ml-2 bg-green-800 hover:bg-green-700" wire:click="public" wire:loading.attr="disabled">
            Publicar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>