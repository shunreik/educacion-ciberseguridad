<x-jet-dialog-modal wire:model="privateMode">
    <x-slot name="title">
        <h1 class="uppercase">Confirmar ocultar lectura</h1>
    </x-slot>

    <x-slot name="content">
        La lectura con el título de: <span class="font-bold">{{ $title }}</span>, va a ser oculta para los estudiantes.
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('privateMode')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-button class="ml-2 bg-pink-800 hover:bg-pink-700" wire:click="private" wire:loading.attr="disabled">
            Ocultar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>