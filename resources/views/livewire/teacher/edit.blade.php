<x-jet-dialog-modal wire:model="editMode">
    <x-slot name="title">
        <h1 class="uppercase">Editar profesor</h1>
    </x-slot>

    <x-slot name="content">
        {{-- Editar profesores --}}
        <x-forms.teacher />
    </x-slot>

    <x-slot name="footer">

        <x-jet-secondary-button wire:click="$set('editMode', false)">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button type='button' wire:click='update' wire:loading.attr="disabled">
            Editar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>