<x-layout>
  <x-slot:title>Equipo</x-slot:title>
  @if(!$user->team_id)
  <div class="w-full flex justify-end">
    <button id="crearEquipo" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-violet-700">
      Crear equipo
    </button>
  </div>
  <div class="w-full flex justify-center">
    <img src="{{ asset('img/TaskFlow.png') }}">
  </div>
  @else
  @if($user->rol == "admin")
  <div class="w-full flex justify-end ">
    <button id="abrir-modal" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-violet-700">
      Agregar Miembro
    </button>
  </div>
  @endif

  <div class="w-full flex flex-col sm:flex-row sm:justify-between">
    <div class="sm:w-[30%] divide-y divide-black ">
      <h2>Miembros del equipo</h2>
      <ul id="teamList" class="miembroEquipo pt-6">
        @foreach($teamMates as $teamMate)
        <li class="teamMember pb-4 sm:pb-5" data-id="{{ $teamMate->id }}">
          <div class="flex items-center space-x-4 rtl:space-x-reverse">
            <div class="shrink-0">
              <img class="w-8 h-8 rounded-full" src="{{ asset('img/TaskFlow.png') }}" alt="Neil image">
            </div>
            <div>
              <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                {{$teamMate->name}}
              </p>
            </div>
          </div>

          <div class="ml-12">
            <p class="text-sm text-violet-950">
              {{$teamMate->email}}
            </p>
          </div>

          <div class="flex justify-between mt-2">
            <span class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white ml-12"><span class="flex w-2.5 h-2.5 bg-blue-600 rounded-full me-1.5 shrink-0"></span>{{ $teamMate->rol }}</span>
            <div>
              @if($user->rol == "admin")
              <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                <button data-edit type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-violet-700">Editar</button>
              </div>
              <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                <button data-delete type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-violet-700">Borrar</button>
              </div>
              @endif

            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>

    <div class="sm:w-1/2 divide-y">
      <h2>Registro del equipo</h2>
      <ol class="mt-7 relative border-s border-violet-950">
        @foreach($logs as $log)
        <li class="mb-10 ms-6">
          <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3  dark:bg-blue-900">
            <img class="rounded-full shadow-lg" src="{{ asset('img/TaskFlow.png') }}" alt="Thomas Lean image" />
          </span>
          <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-xs hover:bg-violet-100">
            <div class="items-center justify-between mb-3 sm:flex">
              <div class="text-sm font-normal text-violet-900 lex">{{ $log->content }}</div>
            </div>
          </div>
        </li>
        @endforeach
      </ol>
    </div>
  </div>

  <div id="crud-modal" class="fixed top-0 left-0 z-50 hidden w-full h-full flex justify-center items-center overflow-y-auto overflow-x-hidden md:inset-0 backdrop-brightness-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow-sm ">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
          <h3 class="text-lg font-semibold text-violet-900">
            Añadir un nuevo miembro al equipo
          </h3>
          <button type="button" id="cerrar-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <div class="p-4 md:p-5">
          <form method="dialog">
            <div class="grid gap-4 mb-4 grid-cols-2">
              <div class="col-span-2">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Escribe el nombre" required />
              </div>
              <div class="col-span-2">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Escribe el email" required>
              </div>
              <div class="col-span-2 sm:col-span-1">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Categoría</label>
                <select id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                  <option value="admin">Admin</option>
                  <option value="user">Usuario</option>
                </select>
              </div>
            </div>
            <button type="submit" id="addTeamMember" class="text-white inline-flex items-center bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Añadir nuevo usuario
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="crud-modal-edit" class="fixed top-0 left-0 z-50 hidden w-full h-full flex justify-center items-center overflow-y-auto overflow-x-hidden md:inset-0 backdrop-brightness-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow-sm">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
          <h3 class="text-lg font-semibold text-violet-900">
            Editar un miembro al equipo
          </h3>
          <button type="button" id="cerrar-modal-edit" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <div class="p-4 md:p-5">
          <form method="dialog">
            <div class="grid gap-4 mb-4 grid-cols-2">
              <div class="col-span-2">
                <label for="name2" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                <input type="text" name="name" id="name2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Escribe el nombre" required />
              </div>
              <div class="col-span-2">
                <label for="email2" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="email" name="email" id="email2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Escribe el email" required>
              </div>
              <div class="col-span-2 sm:col-span-1">
                <label for="role2" class="block mb-2 text-sm font-medium text-gray-900">Categoría</label>
                <select id="role2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                  <option value="admin">Admin</option>
                  <option value="user">Usuario</option>
                </select>
              </div>
            </div>
            <button type="submit" class="text-white inline-flex items-center bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Editar usuario
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="crud-modal-delete" class="hidden fixed top-0 left-0 z-50 w-full h-full bg-black/50 flex justify-center items-center backdrop-brightness-50 ">
    <div id="miModalContainer" class="relative bg-white rounded-lg shadow-sm w-full max-w-md max-h-full">
      <button id="cerrar-modal-delete" type="button" class="absolute top-3 end-2.5 text-violet-900 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Cerrar modal</span>
      </button>
      <div class="p-4 md:p-5 text-center">
        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <h3 id="modalTitulo" class="mb-5 text-lg font-normal text-gray-500">¿Estás seguro de que quieres eliminar este usuario?</h3>
        <form method="dialog">
          <div class="flex justify-center items-center">
            <button id="modalAceptarBtn" type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
              Eliminar usuario
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @endif
  <x-slot:scripts>
    <script src="{{ asset('js/equipos.js') }}"></script>
    <script src="{{ asset('js/crearEquipo.js') }}"></script>
  </x-slot:scripts>
</x-layout>