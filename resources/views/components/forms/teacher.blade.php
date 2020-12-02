
<div class="grid grid-cols-6 gap-6">
    <div class="col-span-6 sm:col-span-3">
        <!-- Name -->
        <x-jet-label for="name" value="Nombre" />
        {{-- <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" /> --}}
        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" />
        <x-jet-input-error for="name" class="mt-2" />
    </div>
    <div class="col-span-6 sm:col-span-3">
        <!-- Surname -->
        <x-jet-label for="surname" value="Apellido" />
        <x-jet-input id="surname" type="text" class="mt-1 block w-full" wire:model.defer="surname" autocomplete="surname" />
        <x-jet-input-error for="surname" class="mt-2" />
    </div>
</div>
<div class="mt-4">
    <!-- Email -->
    <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="email" value="Correo Electrónico" />
        <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
        <x-jet-input-error for="email" class="mt-2" />
    </div>
</div>