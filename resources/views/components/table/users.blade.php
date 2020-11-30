@props(['users', 'role'])
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col mt-4">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <x-table.th content='Username'/>
                <x-table.th content='Apellido'/>
                <x-table.th content='Nombre'/>
                <x-table.th content='Correo'/>
                <x-table.th content='Estado'/>
                <x-table.th content='Opciones'/>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

              {{-- {{var_dump($users[0]->isUserActive('estudiante'))}} --}}
              @foreach ($users as $user)
              {{-- {{var_dump($user->name)}} --}}
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-500">
                        {{$user->nickname}}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $user->surname }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $user->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $user->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if ($user->isUserActive($role))
                    <x-badge-user-status message='Activo'/>
                  @else
                    <x-badge-user-status color='pink' message='Inactivo'/>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex justify-center">
                    @if ($role === 'estudiante')
                      <a href="#" class="text-gray-600 hover:text-gray-900 mx-3">Ver</a>
                      @if ($user->isUserActive($role))
                          <a href="#" class="text-pink-600 hover:text-pink-900 mx-3">Desactivar</a>
                        @else
                          <a href="#" class="text-green-600 hover:text-green-900 mx-3">Activar</a>
                      @endif
                    @endif
                    @if ($role === 'profesor')
                      <a href="#" class="text-gray-600 hover:text-gray-900 mx-3">Ver</a>
                      <a href="#" class="text-blue-600 hover:text-blue-900 mx-3">Editar</a>
                      <a href="#" class="text-pink-600 hover:text-pink-900 mx-3">Desactivar</a>
                    @endif
                  </div>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <div class="my-3">
          {{-- Personalización del paginator de tailwind --}}
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>