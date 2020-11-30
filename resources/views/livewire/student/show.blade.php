<x-jet-dialog-modal wire:model="showMode">
    <x-slot name="title">
        <h1 class="uppercase">Información del estudiante</h1>
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-6 gap-6 mb-3">
            <div class="col-span-6 sm:col-span-3 flex flex-wrap content-center">
                <x-jet-section-title>
                    <x-slot name='title'>Username</x-slot>
                    <x-slot name='description'>{{ $nickname }}</x-slot>
                </x-jet-section-title>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-20 w-20">
                      <img class="h-20 w-20 rounded-full" src="{{ $photo }}" alt="{{ $nickname }}" />
                    </div>
                  </div>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-6 mb-4">
            <div class="col-span-6 sm:col-span-3">
                <x-jet-section-title>
                    <x-slot name='title'>Nombre</x-slot>
                    <x-slot name='description'>{{ $name }}</x-slot>
                </x-jet-section-title>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-jet-section-title>
                    <x-slot name='title'>Apellido</x-slot>
                    <x-slot name='description'>{{ $surname }}</x-slot>
                </x-jet-section-title>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-6 mb-4">
            <div class="col-span-6 sm:col-span-3">
                <x-jet-section-title>
                    <x-slot name='title'>Correo electrónico</x-slot>
                    <x-slot name='description'>{{ $email }}</x-slot>
                </x-jet-section-title>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-jet-section-title>
                    <x-slot name='title'>Fecha de registro</x-slot>
                    <x-slot name='description'>{{ $dateRegistration }}</x-slot>
                </x-jet-section-title>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-6 mb-4">
            <div class="col-span-6 sm:col-span-3">
                <x-jet-section-title>
                    <x-slot name='title'>Correo verificado</x-slot>
                    <x-slot name='description'>{{ $verifiedMail ? "Si" : "No"  }}</x-slot>
                </x-jet-section-title>
            </div>
            @if ($verifiedMail)
            <div class="col-span-6 sm:col-span-3">
                <x-jet-section-title>
                    <x-slot name='title'>Fecha de verificación</x-slot>
                    <x-slot name='description'>{{ $dateVerified }}</x-slot>
                </x-jet-section-title>
            </div>
            @endif
        </div>


    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showMode')" wire:loading.attr="disabled">
            Cerrar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>