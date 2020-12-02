@props(['href'=> '#'])
<a href="{{ $href }}">
    <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
        <div>{{ $slot }}</div>
        <div class="ml-1 text-indigo-500">
            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </div>
    </div>
</a>