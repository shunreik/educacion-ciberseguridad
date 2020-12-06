@props(['data'])
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col mt-4">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <x-tables.th content='Título'/>
                <x-tables.th content='Temática'/>
                <x-tables.th content='Nivel'/>
                <x-tables.th content='Estado'/>
                <x-tables.th content='Opciones'/>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

              @foreach ($data as $reading)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $reading->title }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $reading->topic->title }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $reading->level->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if ($reading->status)
                    <x-badge-user-status message='Público'/>
                  @else
                    <x-badge-user-status color='pink' message='Privado'/>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex justify-center">

                      <button class="text-gray-600 hover:text-gray-900 mx-3" wire:click="show({{ $reading->id}})">Ver</button>
                      <button class="text-blue-600 hover:text-blue-900 mx-3">Editar</button>
                      {{-- <button class="text-pink-600 hover:text-pink-900 mx-3">Desactivar</button> --}}
                      {{-- <button wire:click="confirmActive({{ $user->id }})" class="text-green-600 hover:text-green-900 mx-3">Activar</button> --}}

                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="my-3">
          {{-- Personalización del paginator de tailwind --}}
          {{ $data->links() }}
        </div>
      </div>
    </div>
  </div>