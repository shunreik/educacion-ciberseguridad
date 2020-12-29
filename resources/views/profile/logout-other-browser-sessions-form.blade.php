<x-jet-action-section>
    <x-slot name="title">
        Administrar Sesiones
        {{-- {{ __('Browser Sessions') }} --}}
    </x-slot>

    <x-slot name="description">
        Gestione y cierre la sesión de sus sesiones activas en otros navegadores y dispositivos
        {{-- {{ __('Manage and logout your active sessions on other browsers and devices.') }} --}}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            Si es necesario, puede cerrar sesión en todas las demás sesiones iniciadas en navegador o dispositivo. Algunas de sus sesiones recientes se enumeran a continuación; sin embargo, esta lista puede no ser exhaustiva. Si cree que su cuenta se ha visto comprometida, también debe actualizar su contraseña.
            {{-- {{ __('If necessary, you may logout of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }} --}}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="flex items-center">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500">
                                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            @endif
                        </div>

                        <div class="ml-3">
                            <div class="text-sm text-gray-600">
                                {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">Sesión actual</span>
                                        {{-- <span class="text-green-500 font-semibold">{{ __('This device') }}</span> --}}
                                    @else
                                        Ultima sessión {{ $session->last_active }}
                                        {{-- {{ __('Last active') }} {{ $session->last_active }} --}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <x-jet-button wire:click="confirmLogout" wire:loading.attr="disabled">
                Cerrar sesiones iniciadas anteriormente
                {{-- {{ __('Logout Other Browser Sessions') }} --}}
            </x-jet-button>

            <x-jet-action-message class="ml-3" on="loggedOut">
                Realizado.
                {{-- {{ __('Done.') }} --}}
            </x-jet-action-message>
        </div>

        <!-- Logout Other Devices Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                Confirmación para el cierre de sesiones anteriores
                {{-- {{ __('Logout Other Browser Sessions') }} --}}
            </x-slot>

            <x-slot name="content">
                Introduce tu contraseña para confirmar que quieres cerrar todas las sessiones iniciadas con anterioridad en otros dispositivos.
                Recuerda que se mantiene la sesión actual.
                {{-- {{ __('Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.') }} --}}

                <div class="mt-4" x-data="{ show: true }" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    
                    
                    {{-- <x-jet-input type="password" class="mt-1 block w-3/4" placeholder="Contraseña"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" /> --}}

                    <div class="relative">
                        <input id="password" name="password" :type="show ? 'password' : 'text'" placeholder="Contraseña" class="form-input rounded-md shadow-sm block mt-1 w-full" required
                            x-ref="password"
                            wire:model.defer="password"
                            wire:keydown.enter="logoutOtherBrowserSessions" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
            
                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                                viewbox="0 0 576 512">
                                <path fill="currentColor"
                                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                </path>
                                </svg>
            
                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                                viewbox="0 0 640 512">
                                <path fill="currentColor"
                                    d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                </path>
                                </svg>
            
                            </div>
                        </div>

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    Cancelar
                    {{-- {{ __('Nevermind') }} --}}
                </x-jet-secondary-button>

                <x-jet-button class="ml-2" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    Cerrar sessiones anteriores
                    {{-- {{ __('Logout Other Browser Sessions') }} --}}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
