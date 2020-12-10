<x-jet-dialog-modal wire:model="publishMode">
    <x-slot name="title">
        <h1 class="uppercase">Confirmar publicación del cuestionario</h1>
    </x-slot>

    <x-slot name="content">
        <p class="my-2">Para que el cuestionario pueda ser público debe cumplir con los siguientes aspectos:</p>
        <ul class="text-sm">
            <li>* Tener un mínimo de tres preguntas registradas</li>
            <li>* Cada pregunta debe tener una respuesta registrada</li>
            <li>* Cada pregunta debe tener por lo menos una opción registrada</li>
        </ul>
        <p class="my-2">Si cumple con dichos aspectos, puede publicar el cuestionario.</p>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('publishMode')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-button class="ml-2 bg-green-800 hover:bg-green-700" wire:click="publishQuestionnarie" wire:loading.attr="disabled">
            Publicar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>