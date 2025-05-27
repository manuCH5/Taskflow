@props(['active' ])
<a {{ $attributes }} class="{{ $active ? 'bg-white text-violet-950' : 'text-violet-950 hover:bg-white '  }} block rounded-md px-3 py-2 text-base font-medium" aria-current="{{ $active ? 'page':'false' }}">{{ $slot }}</a>

