<div class="px-10 pt-3">
    <label class="p-x">{{ $slot }}
        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
            <input 
                {{ $attributes }}
                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-gray-900 placeholder:text-gray-400 focus:outline-none text-balance">
        </div>
    </label>
</div>