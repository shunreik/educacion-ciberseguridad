<x-jet-dialog-modal wire:model="confirmEditModal">
    <x-slot name="title">
        <h1 class="uppercase">Confirmar modificación del cuestionario</h1>
    </x-slot>

    <x-slot name="content">
        Para realizar cambios en un cuestionario que ha sido publicado previamente, se procede a ocultarlo para impedir su acceso a los estudiantes. Al terminar de realizar
        los cambios debes publicarlo nuevamente.
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmEditModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-button class="ml-2 bg-green-800 hover:bg-green-700" wire:click="privateQuestionnarie" wire:loading.attr="disabled">
            Confirmar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>