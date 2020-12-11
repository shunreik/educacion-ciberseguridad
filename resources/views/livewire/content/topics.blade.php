<div class="md:col-span-1">
    <div class="px-4 sm:px-0">
        <h3 class="mt-2 text-2xl font-medium text-gray-900">Temáticas</h3>

        <p class="mt-1 text-sm text-gray-600">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti illum alias perspiciatis ut error exercitationem commodi deleniti at sequi officiis fugiat ratione, soluta maxime vel odio, hic nulla nostrum? Modi!
        </p>
    </div>
</div>


<div class="flex items-center justify-center px-5 py-5">
    <div class="w-full max-w-3xl">
        <div class="-mx-2 md:flex">

            @foreach ($topics as $topic)
            <div class="w-full md:w-1/3 px-2">
                <div class="rounded-lg shadow-sm mb-4">
                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                        <div class="px-3 pt-8 pb-10 text-center relative z-10">
                            <h4 class="text-sm uppercase text-gray-500 leading-tight">{{ $topic->title }}</h4>
                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ count($topic->readings )}}</h3>
                            <p class="text-xs text-green-500 leading-tight">Lecturas</p>
                            <x-jet-button class="mt-3 w-1/2" wire:click="listReadings"><span class="mx-auto">Ver</span></x-jet-button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>