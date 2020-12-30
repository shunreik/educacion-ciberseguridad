@props(['data'])
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col mt-4">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <x-tables.th content='Lectura'/>
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
                  @if ($reading->questionnarie)
                      @if ($reading->questionnarie->status)
                          <x-badge-user-status message='Público'/>
                        @else
                          <x-badge-user-status color='pink' message='Oculto'/>
                      @endif
                  @else
                    <span class="px-4 text-gray-600 text-sm text-center">N/A</span>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex justify-center">
                    @if (is_null($reading->questionnarie))
                      <button class="text-green-600 hover:text-green-900 mx-3" wire:click="questionnarie({{ $reading->id }})">Agregar cuestionario</button>
                    @else
                      @if ($reading->questionnarie->status)
                        <button class="text-blue-600 hover:text-blue-900 mx-3" wire:click="confirmEdit({{ $reading->id}},{{ $reading->questionnarie->id }})">Editar cuestionario</button>
                        @else
                        <button class="text-blue-600 hover:text-blue-900 mx-3" wire:click="questionnarie({{ $reading->id }})">Editar cuestionario</button>
                      @endif
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
          {{ $data->links() }}
        </div>
      </div>
    </div>
  </div>