<x-jet-dialog-modal wire:model="confirmingDisable">
    <x-slot name="title">
        <h1 class="uppercase">Confirmar desactivación del estudiante</h1>
    </x-slot>

    <x-slot name="content">
        El usuario <span class="font-bold">{{ $nickname }}</span> va ser desactivado, impidiendo su acceso a la aplicación web.
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingDisable')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-button class="ml-2 bg-pink-800 hover:bg-pink-700" wire:click="disable" wire:loading.attr="disabled">
            Desactivar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>