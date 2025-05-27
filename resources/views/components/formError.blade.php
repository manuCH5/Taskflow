@props(['name'])

@error($name)
    <p class="px-10 text-xs text-red-500 fonr-semibold mt-1">{{ $message }}</p>
@enderror