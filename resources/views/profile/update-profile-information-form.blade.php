<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        Información Personal
        {{-- {{ __('Profile Information') }} --}}
    </x-slot>

    <x-slot name="description">
        Actualiza la información y el correo electrónico de tu cuenta.
        {{-- {{ __('Update your account\'s profile information and email address.') }} --}}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                {{-- <x-jet-label for="photo" value="Foto" /> --}}

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    Seleccionar nueva foto
                    {{-- {{ __('Select A New Photo') }} --}}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        Eliminar foto
                        {{-- {{ __('Remove Photo') }} --}}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="Nombre" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="surname" value="Apellido" />
            <x-jet-input id="surname" type="text" class="mt-1 block w-full" wire:model.defer="state.surname" autocomplete="surname" />
            <x-jet-input-error for="surname" class="mt-2" />
        </div>

        <!-- Nickname -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nickname" value="Usuario" />
            <x-jet-input id="nickname" type="text" class="mt-1 block w-full" wire:model.defer="state.nickname" autocomplete="nickname" />
            <x-jet-input-error for="nickname" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="Correo Electrónico" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            Guardado.
            {{-- {{ __('Saved.') }} --}}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            Guardar
            {{-- {{ __('Save') }} --}}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
