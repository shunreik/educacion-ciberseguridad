@props(['color'=>'green','message'])
<div>
    <span {{ $attributes->merge([ 'class'=> "px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-$color-100 text-$color-800"])}}>
        {{ $message }}
    </span>
</div>