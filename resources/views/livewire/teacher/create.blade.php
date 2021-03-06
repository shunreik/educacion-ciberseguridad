<x-jet-dialog-modal wire:model="createMode">
    <x-slot name="title">
        <h1 class="uppercase">Registrar profesor</h1>
    </x-slot>

    <x-slot name="content">
        {{-- Registrar profesores --}}
        <x-forms.teacher />
    </x-slot>

    <x-slot name="footer">

        <x-jet-secondary-button wire:click="$set('createMode', false)">
            {{-- wire:click="$toggle('showMode')" wire:loading.attr="disabled" --}}
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button type='button' wire:click='store' wire:loading.attr="disabled">
            Registrar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>