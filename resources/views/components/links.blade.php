@props(['active' ])
<a {{ $attributes }} class="{{ $active ? 'bg-white text-violet-950' : 'text-violet-950 hover:bg-white '  }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $active ? 'page':'false' }}">{{ $slot }}</a>
