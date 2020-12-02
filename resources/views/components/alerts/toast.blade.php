@props(['color'=>'green'])
{{-- <div {{ $attributes->merge(['class' => "fixed z-40 bottom-10 right-10 flex justify-between content-center bg-$color-200 text-$color-600 py-3 px-3 rounded-lg"])}}> --}}
<div {{ $attributes->merge(['class' => "absolute z-40 top-20 right-10 flex justify-between content-center bg-$color-200 text-$color-600 py-3 px-3 rounded-lg"])}}>
    <span class="font-semibold text-{{$color}}-700 mx-4">
        {{ $message }}
    </span>
    {{ $slot }}
</div>
