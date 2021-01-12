<x-jet-dialog-modal wire:model="confirmingActive">
    <x-slot name="title">
        <h1 class="uppercase">Confirmar activación del estudiante</h1>
    </x-slot>

    <x-slot name="content">
        El estudiante <span class="font-bold">{{ $nickname }}</span> va a ser activado, permitiendo su acceso a la Aplicación Web.
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingActive')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-button class="ml-2 bg-green-800 hover:bg-green-700" wire:click="active" wire:loading.attr="disabled">
            Activar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>