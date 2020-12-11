
<div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
    <div class="overflow-hidden rounded-lg shadow-lg px-4 py-3">

        <h1 class="text-lg font-semibold text-gray-800 mt-2">{{ $title }}</h1>
        <div class="flex justify-between items-center mt-4">
            <div class="flex items-center">
                <img src="{{ $photo }}"
                        class="w-8 h-8 object-cover rounded-full" alt="avatar">
                <span class="text-gray-700 text-sm mx-3">{{ $autor }}</span>
            </div>
            <span class="font-light text-sm text-gray-600">{{ $date }}</span>
        </div>
        <p class="text-gray-600 text-sm mt-2">{{ $description }}</p>

        <div class="flex justify-between items-center mt-2">
            {{ $slot }}
        </div>
    </div>
</div>